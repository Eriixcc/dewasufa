<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Destination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    /**
     * Display a listing of comments.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Comment::with('destination')->where('status', 'published')->orderBy('id', 'desc');

        $destId = $request->input('destination_id');
        $slug = $request->input('destination_slug');

        if (! empty($destId) && ! empty($slug)) {
            $destId = (int) $destId;
            $slug = strtolower($slug);
            $query->where(function ($q) use ($destId, $slug) {
                $q->where('destination_id', $destId)
                    ->orWhere('destination_slug', $slug)
                    ->orWhereHas('destination', function ($destQuery) use ($destId, $slug) {
                        $destQuery->where('id', $destId)
                            ->orWhere('name', 'like', "%{$slug}%");
                    });
            });
        } elseif (! empty($destId)) {
            $destId = (int) $destId;
            $query->where(function ($q) use ($destId) {
                $q->where('destination_id', $destId)
                    ->orWhereHas('destination', function ($destQuery) use ($destId) {
                        $destQuery->where('id', $destId);
                    });
            });
        } elseif (! empty($slug)) {
            $slug = strtolower($slug);
            $query->where(function ($q) use ($slug) {
                $q->where('destination_slug', $slug)
                    ->orWhere('destination_id', is_numeric($slug) ? (int) $slug : 0)
                    ->orWhereHas('destination', function ($destQuery) use ($slug) {
                        $destQuery->where('name', 'like', "%{$slug}%")
                            ->orWhere('category', 'like', "%{$slug}%");
                    });
            });
        }

        $comments = $query->get();

        $totalCount = $comments->count();
        $avgRating = $totalCount > 0 ? round((float) $comments->avg('rating'), 1) : 0.0;
        $ratingBreakdown = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
        foreach ($comments as $c) {
            $star = (int) round((float) $c->rating);
            if (isset($ratingBreakdown[$star])) {
                $ratingBreakdown[$star]++;
            }
        }

        $filterRating = $request->input('rating');
        $filteredComments = $comments;
        if (! empty($filterRating) && $filterRating !== 'all' && is_numeric($filterRating)) {
            $targetStar = (int) $filterRating;
            $filteredComments = $comments->filter(fn ($c) => (int) round((float) $c->rating) === $targetStar)->values();
        }

        return response()->json([
            'success' => true,
            'count' => $totalCount,
            'filtered_count' => $filteredComments->count(),
            'avg_rating' => $avgRating,
            'rating_breakdown' => $ratingBreakdown,
            'comments' => $filteredComments,
        ]);
    }

    /**
     * Store a newly created comment in database.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'destination_id' => 'nullable|integer',
            'destination_slug' => 'nullable|string|max:100',
            'destination_name' => 'nullable|string|max:255',
            'author_name' => 'required|string|max:100',
            'author_role' => 'nullable|string|max:100',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string|max:3000',
            'photos' => 'nullable',
        ]);

        $destinationId = $validated['destination_id'] ?? null;
        $destinationSlug = $validated['destination_slug'] ?? null;
        $destinationName = $validated['destination_name'] ?? null;

        if ($destinationId) {
            $destination = Destination::find($destinationId);
            if ($destination) {
                if (empty($destinationName)) {
                    $destinationName = $destination->name;
                }
                if (empty($destinationSlug)) {
                    $destinationSlug = Str::slug($destination->name);
                }
            }
        } elseif (! empty($destinationSlug)) {
            $destination = Destination::where('id', is_numeric($destinationSlug) ? (int) $destinationSlug : 0)
                ->orWhere('name', 'like', "%{$destinationSlug}%")
                ->orWhere('category', 'like', "%{$destinationSlug}%")
                ->first();
            if ($destination) {
                $destinationId = $destination->id;
                if (empty($destinationName)) {
                    $destinationName = $destination->name;
                }
            }
        }

        $savedPhotos = [];
        $targetDir = public_path('images/uploads/comments');
        if (! file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // 1. Process uploaded files if multipart/form-data
        if ($request->hasFile('photos')) {
            $files = $request->file('photos');
            if (! is_array($files)) {
                $files = [$files];
            }
            foreach (array_slice($files, 0, 3) as $file) {
                if ($file && $file->isValid()) {
                    $ext = $file->getClientOriginalExtension() ?: 'jpg';
                    $fileName = 'cmt_'.time().'_'.uniqid().'.'.$ext;
                    $file->move($targetDir, $fileName);
                    $savedPhotos[] = 'images/uploads/comments/'.$fileName;
                }
            }
        }

        // 2. Process base64 data URLs or strings if passed in photos payload
        $rawPhotos = $request->input('photos');
        if (is_array($rawPhotos)) {
            foreach ($rawPhotos as $item) {
                if (count($savedPhotos) >= 3) {
                    break;
                }
                if (is_string($item) && str_starts_with($item, 'data:image')) {
                    if (preg_match('/^data:image\/(\w+);base64,/', $item, $matches)) {
                        $ext = strtolower($matches[1]);
                        if (! in_array($ext, ['jpeg', 'jpg', 'png', 'webp'])) {
                            $ext = 'jpg';
                        }
                        $base64Data = substr($item, strpos($item, ',') + 1);
                        $decoded = base64_decode($base64Data);
                        if ($decoded !== false) {
                            $fileName = 'cmt_'.time().'_'.uniqid().'.'.$ext;
                            file_put_contents($targetDir.'/'.$fileName, $decoded);
                            $savedPhotos[] = 'images/uploads/comments/'.$fileName;
                        }
                    }
                } elseif (is_string($item) && ! empty($item) && ! str_starts_with($item, 'data:')) {
                    $savedPhotos[] = $item;
                }
            }
        }

        $comment = Comment::create([
            'destination_id' => $destinationId,
            'destination_slug' => $destinationSlug,
            'destination_name' => $destinationName,
            'author_name' => $validated['author_name'],
            'author_role' => $validated['author_role'] ?? 'Wisatawan Terverifikasi',
            'rating' => (float) $validated['rating'],
            'comment' => $validated['comment'],
            'photos' => ! empty($savedPhotos) ? $savedPhotos : null,
            'status' => 'published',
        ]);

        $destinationRating = 0.0;
        $destinationReviewsCount = 0;
        if ($destinationId) {
            $dest = Destination::find($destinationId);
            if ($dest) {
                $dest->recalculateRating();
                $dest->refresh();
                $destinationRating = (float) ($dest->rating ?? 0.0);
                $destinationReviewsCount = (int) ($dest->reviews_count ?? 0);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Ulasan Anda berhasil dikirimkan ke database!',
            'comment' => $comment->fresh(),
            'destination_rating' => $destinationRating,
            'destination_reviews_count' => $destinationReviewsCount,
        ], 201);
    }
}
