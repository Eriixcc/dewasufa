<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DestinationView;
use Illuminate\Http\JsonResponse;
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
    public function dashboard(): View
    {
        $destinations = Destination::published()->orderBy('id', 'asc')->get();
        $latestDestinations = Destination::published()->latest()->take(4)->get();
        $featured = $destinations->first();

        /** @var Collection<int, Destination> $recentlyViewed */
        $recentlyViewed = collect();
        if (Auth::check()) {
            $recentlyViewed = DestinationView::where('user_id', Auth::id())
                ->with('destination')
                ->orderByDesc('updated_at')
                ->take(4)
                ->get()
                ->pluck('destination')
                ->filter()
                ->values();
        }

        return view('dashboard', compact('destinations', 'latestDestinations', 'featured', 'recentlyViewed'));
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

        // updateOrCreate to avoid duplicates, then touch updated_at to track recency
        DestinationView::updateOrCreate(
            ['user_id' => $userId, 'destination_id' => $destination->id],
        );

        DestinationView::where('user_id', $userId)
            ->where('destination_id', $destination->id)
            ->touch();

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
