<?php

use App\Http\Controllers\VisitController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\VisitController as AdminVisitController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [VisitController::class, 'home'])->name('home');
Route::get('/explore', [VisitController::class, 'explore'])->name('explore');
Route::get('/visit/{visit:slug}', [VisitController::class, 'show'])->name('visit.show');

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes (protected)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('visits', AdminVisitController::class);
});
