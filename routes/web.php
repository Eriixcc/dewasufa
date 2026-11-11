<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DestinationController;
use Illuminate\Support\Facades\Route;

// Public Front Page
Route::get('/', [DestinationController::class, 'welcome'])->name('home');

// Authentication Routes
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/register', [AuthController::class, 'signup'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']);

// User Dashboard
Route::get('/dashboard', [DestinationController::class, 'dashboard'])->name('dashboard');

// Admin Dashboard & Destination CRUD
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/dashboard', [AdminController::class, 'index']);
Route::post('/admin/destinations', [AdminController::class, 'store'])->name('admin.destinations.store');
Route::post('/admin/destinations/{destination}', [AdminController::class, 'update'])->name('admin.destinations.update');
Route::delete('/admin/destinations/{destination}', [AdminController::class, 'destroy'])->name('admin.destinations.destroy');

// Admin Comment Moderation
Route::delete('/admin/comments/{comment}', [AdminController::class, 'destroyComment'])->name('admin.comments.destroy');

// Public JSON Endpoints for realtime frontend sync
Route::get('/api/destinations', [DestinationController::class, 'apiIndex'])->name('api.destinations.index');
Route::get('/api/destinations/{destination}', [DestinationController::class, 'apiShow'])->name('api.destinations.show');
Route::get('/api/comments', [CommentController::class, 'index'])->name('api.comments.index');
Route::post('/api/comments', [CommentController::class, 'store'])->name('api.comments.store');
