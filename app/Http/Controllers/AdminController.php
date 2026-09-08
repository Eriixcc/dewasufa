<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display the Dewasufa Admin Dashboard.
     */
    public function index(): View
    {
        return view('admin.dashboard');
    }
}
