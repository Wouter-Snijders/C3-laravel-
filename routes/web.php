<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdvertentieController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\StandController;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard route
Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Advertentie routes
    Route::get('/advertenties/create', [AdvertentieController::class, 'create'])->name('advertenties.create');
    Route::post('/advertenties', [AdvertentieController::class, 'store'])->name('advertenties.store');
    Route::get('/advertenties/{id}/edit', [AdvertentieController::class, 'edit'])->name('advertenties.edit');
    Route::put('/advertenties/{id}', [AdvertentieController::class, 'update'])->name('advertenties.update');
    Route::delete('/advertenties/{id}', [AdvertentieController::class, 'destroy'])->name('advertenties.destroy');
    Route::get('/mijn-advertenties', [AdvertentieController::class, 'myAdvertisements'])->name('mijn.advertenties');

    // Team routes (admin only)
    Route::get('/admin', [TeamController::class, 'index'])->name('admin');
    Route::post('/teams', [TeamController::class, 'store'])->name('team.store');
    Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('team.destroy');
    Route::put('/teams/{team}', [TeamController::class, 'update'])->name('team.update');
});

// Cart routes
Route::post('/api/cart', [CartController::class, 'addToCart']);
Route::get('/api/cart', [CartController::class, 'getCartItems']);
Route::get('/winkelmand', [CartController::class, 'index']);

// Favorieten route
Route::get('/favorieten', [ProductController::class, 'favorieten'])->name('favorieten');

// Speelschema route
Route::get('/speelschema', function () {
    return view('speelschema');
})->name('speelschema');

// Standings route
Route::get('/stand', function () {
    return view('stand');
})->name('stand');

Route::get('/inzet', function () {
    return view('inzet');
})->name('inzet');

// Route voor de standenpagina
Route::get('/stand', [StandController::class, 'index'])->name('stand');

// Auth routes
require __DIR__.'/auth.php';
