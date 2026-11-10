<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Destination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of comments.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Comment::with('destination')->where('status', 'published')->orderBy('id', 'desc');

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->integer('destination_id'));
        } elseif ($request->filled('destination_slug')) {
            $slug = strtolower($request->input('destination_slug'));
            $query->where(function ($q) use ($slug) {
                $q->where('destination_slug', $slug)
                    ->orWhereHas('destination', function ($destQuery) use ($slug) {
                        $destQuery->where('name', 'like', "%{$slug}%")
                            ->orWhere('category', 'like', "%{$slug}%");
                    });
            });
        }

        $comments = $query->get();

        return response()->json([
            'success' => true,
            'count' => $comments->count(),
            'comments' => $comments,
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
        $destinationName = $validated['destination_name'] ?? null;

        if ($destinationId && empty($destinationName)) {
            $destination = Destination::find($destinationId);
            if ($destination) {
                $destinationName = $destination->name;
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
            'destination_slug' => $validated['destination_slug'] ?? null,
            'destination_name' => $destinationName,
            'author_name' => $validated['author_name'],
            'author_role' => $validated['author_role'] ?? 'Wisatawan Terverifikasi',
            'rating' => (float) $validated['rating'],
            'comment' => $validated['comment'],
            'photos' => ! empty($savedPhotos) ? $savedPhotos : null,
            'status' => 'published',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ulasan Anda berhasil dikirimkan ke database!',
            'comment' => $comment->fresh(),
        ], 201);
    }
}
