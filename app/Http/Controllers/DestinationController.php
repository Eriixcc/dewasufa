<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DestinationController extends Controller
{
    /**
     * Display the public welcome page with real-time destinations.
     */
    public function welcome(): View
    {
        $destinations = Destination::orderBy('id', 'asc')->get();

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
     * Display the user dashboard with real-time destinations.
     */
    public function dashboard(): View
    {
        $destinations = Destination::orderBy('id', 'asc')->get();
        $latestDestinations = Destination::latest()->take(4)->get();
        $featured = $destinations->first();

        return view('dashboard', compact('destinations', 'latestDestinations', 'featured'));
    }

    /**
     * Return all destinations as JSON for client-side consumption.
     */
    public function apiIndex(): JsonResponse
    {
        return response()->json(Destination::orderBy('id', 'asc')->get());
    }

    /**
     * Return a single destination as JSON.
     */
    public function apiShow(Destination $destination): JsonResponse
    {
        return response()->json($destination);
    }
}
