<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdvertentieController;
use App\Http\Controllers\TeamController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home route
Route::get('/', [AdvertentieController::class, 'index'])->name('home');

// Dashboard route
Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Advertentie routes
Route::get('/advertenties/create', [AdvertentieController::class, 'create'])->name('advertenties.create');
Route::post('/advertenties', [AdvertentieController::class, 'store'])->name('advertenties.store');
Route::get('/advertenties/{id}/edit', [AdvertentieController::class, 'edit'])->name('advertenties.edit');
Route::put('/advertenties/{id}', [AdvertentieController::class, 'update'])->name('advertenties.update');
Route::delete('/advertenties/{id}', [AdvertentieController::class, 'destroy'])->name('advertenties.destroy');

// Advertenties van de ingelogde gebruiker
Route::get('/mijn-advertenties', [AdvertentieController::class, 'myAdvertisements'])->name('mijn.advertenties');
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

// Admin panel route
Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/', [HomeController::class, 'index'])->name('home');

// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::post('/teams', [TeamController::class, 'store'])->name('team.store');
    Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('team.destroy');
    Route::put('/teams/{team}', [TeamController::class, 'update'])->name('team.update');
});

Route::get('/inzet', function () {
    return view('inzet');
})->name('inzet');

// Auth routes
require __DIR__.'/auth.php';
