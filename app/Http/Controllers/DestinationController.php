<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DestinationView;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DestinationController extends Controller
{
    /**
     * Display the public welcome page with published ('post') destinations.
     */
    public function welcome(): View
    {
        $destinations = Destination::published()->orderBy('id', 'asc')->get();

        $counts = [
            'total' => $destinations->count(),
            'waterfall' => $destinations->filter(fn (Destination $d) => stripos($d->category, 'waterfall') !== false)->count(),
            'sunset' => $destinations->filter(fn (Destination $d) => stripos($d->category, 'sunset') !== false)->count(),
            'sunrise' => $destinations->filter(fn (Destination $d) => stripos($d->category, 'sunrise') !== false)->count(),
            'mountain' => $destinations->filter(fn (Destination $d) => stripos($d->category, 'mountain') !== false || stripos($d->category, 'gunung') !== false)->count(),
        ];

        return view('welcome', compact('destinations', 'counts'));
    }

    /**
     * Display the user dashboard with published ('post') destinations.
     */
    public function dashboard(): View|RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->route('home')->with('error', 'Silakan masuk ke akun Anda terlebih dahulu.');
        }

        $destinations = Destination::published()->orderBy('id', 'asc')->get();
        $latestDestinations = Destination::published()->latest()->take(4)->get();
        $featured = $destinations->first();

        /** @var Collection<int, Destination> $recentlyViewed */
        $recentlyViewed = DestinationView::where('user_id', Auth::id())
            ->with('destination')
            ->orderByDesc('updated_at')
            ->take(4)
            ->get()
            ->pluck('destination')
            ->filter()
            ->values();

        // Hero slider: 3 slides from real data
        $trending = Destination::published()
            ->withCount('views')
            ->orderByDesc('views_count')
            ->orderByDesc('reviews_count')
            ->first();

        $newest = Destination::published()
            ->latest()
            ->first();

        $topRated = Destination::published()
            ->where('reviews_count', '>', 0)
            ->orderByDesc('rating')
            ->orderByDesc('reviews_count')
            ->first();

        $trending = $trending ?? $featured;
        $newest = $newest ?? $featured;
        $topRated = $topRated ?? $featured;

        return view('dashboard', compact('destinations', 'latestDestinations', 'featured', 'recentlyViewed', 'trending', 'newest', 'topRated'));
    }

    /**
     * Record that the authenticated user viewed a destination.
     */
    public function recordView(Request $request, Destination $destination): JsonResponse
    {
        if (! Auth::check()) {
            return response()->json(['success' => false], 401);
        }

        $userId = Auth::id();

        // updateOrCreate to track recency via updated_at
        $view = DestinationView::updateOrCreate(
            ['user_id' => $userId, 'destination_id' => $destination->id],
            ['updated_at' => now()]
        );

        $view->touch();

        return response()->json(['success' => true]);
    }

    /**
     * Clear all destination views history for the authenticated user.
     */
    public function clearHistory(): JsonResponse
    {
        if (Auth::check()) {
            DestinationView::where('user_id', Auth::id())->delete();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Return all published destinations as JSON for client-side consumption.
     */
    public function apiIndex(): JsonResponse
    {
        return response()->json(Destination::published()->orderBy('id', 'asc')->get());
    }

    /**
     * Return a single destination as JSON.
     */
    public function apiShow(Destination $destination): JsonResponse
    {
        if ($destination->status === 'pending') {
            abort(404, 'Destinasi ini masih pending dan belum dipublikasikan.');
        }

        return response()->json($destination);
    }
}
