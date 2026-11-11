<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Destination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display the Dewasufa Admin Dashboard with real-time database data.
     */
    public function index(): View
    {
        $destinations = Destination::orderBy('id', 'desc')->get();
        $comments = Comment::with('destination')->orderBy('id', 'desc')->get();

        $stats = [
            'total' => $destinations->count(),
            'post' => $destinations->where('status', 'post')->count(),
            'pending' => $destinations->where('status', 'pending')->count(),
            'draft' => $destinations->where('status', 'pending')->count(),
            'comments' => $comments->count(),
            'waterfall' => $destinations->filter(fn (Destination $d) => stripos($d->category, 'waterfall') !== false)->count(),
            'sunset' => $destinations->filter(fn (Destination $d) => stripos($d->category, 'sunset') !== false)->count(),
            'sunrise' => $destinations->filter(fn (Destination $d) => stripos($d->category, 'sunrise') !== false)->count(),
            'mountain' => $destinations->filter(fn (Destination $d) => stripos($d->category, 'mountain') !== false || stripos($d->category, 'gunung') !== false)->count(),
        ];

        return view('admin.dashboard', compact('destinations', 'stats', 'comments'));
    }

    /**
     * Store a newly created destination in database.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable',
            'image' => 'nullable',
            'status' => 'nullable|string|in:post,pending',
        ]);

        $status = in_array($request->input('status'), ['post', 'pending']) ? $request->input('status') : 'post';

        $data = [
            'name' => $validated['name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'price' => $this->parsePrice($request->input('price')),
            'status' => $status,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $targetDir = public_path('images/uploads');
            if (! file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $file->move($targetDir, $fileName);
            $data['image'] = 'images/uploads/'.$fileName;
        } elseif ($request->filled('image') && is_string($request->input('image'))) {
            $data['image'] = $request->input('image');
        }

        $destination = Destination::create($data);

        if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Destinasi "'.$destination->name.'" berhasil ditambahkan ke database!',
                'destination' => $destination,
            ], 201);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Destinasi berhasil ditambahkan!');
    }

    /**
     * Update the specified destination in database.
     */
    public function update(Request $request, Destination $destination): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable',
            'image' => 'nullable',
            'status' => 'nullable|string|in:post,pending',
        ]);

        $status = in_array($request->input('status'), ['post', 'pending']) ? $request->input('status') : ($destination->status ?? 'post');

        $data = [
            'name' => $validated['name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'price' => $this->parsePrice($request->input('price')),
            'status' => $status,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $targetDir = public_path('images/uploads');
            if (! file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $file->move($targetDir, $fileName);
            $data['image'] = 'images/uploads/'.$fileName;
        } elseif ($request->filled('image') && is_string($request->input('image')) && ! str_starts_with($request->input('image'), 'data:')) {
            $data['image'] = $request->input('image');
        }

        $destination->update($data);

        if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Destinasi "'.$destination->name.'" berhasil diperbarui di database!',
                'destination' => $destination->fresh(),
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Destinasi berhasil diperbarui!');
    }

    /**
     * Remove the specified destination from database.
     */
    public function destroy(Request $request, Destination $destination): JsonResponse|RedirectResponse
    {
        $name = $destination->name;
        $destination->delete();

        if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Destinasi "'.$name.'" berhasil dihapus dari database.',
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Destinasi berhasil dihapus!');
    }

    /**
     * Remove the specified comment from database.
     */
    public function destroyComment(Request $request, Comment $comment): JsonResponse|RedirectResponse
    {
        $author = $comment->author_name;

        // Clean up uploaded comment photos if stored in public/images/uploads/comments
        if (! empty($comment->photos) && is_array($comment->photos)) {
            foreach ($comment->photos as $photo) {
                if (is_string($photo) && str_starts_with($photo, 'images/uploads/comments/')) {
                    $fullPath = public_path($photo);
                    if (file_exists($fullPath)) {
                        @unlink($fullPath);
                    }
                }
            }
        }

        $destId = $comment->destination_id;
        $comment->delete();

        if ($destId) {
            $dest = Destination::find($destId);
            if ($dest) {
                $dest->recalculateRating();
            }
        }

        if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Komentar dari "'.$author.'" berhasil dihapus dari database.',
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Komentar berhasil dihapus!');
    }

    /**
     * Parse raw price strings into float numbers.
     */
    protected function parsePrice(mixed $price): float
    {
        if (is_numeric($price)) {
            return (float) $price;
        }

        if (empty($price)) {
            return 0.0;
        }

        $clean = preg_replace('/[^\d]/', '', (string) $price);

        return (float) ($clean ?: 0);
    }
}
