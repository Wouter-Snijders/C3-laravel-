<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdvertentieController;
use App\Http\Controllers\TeamLeiderController;
use App\Http\Controllers\StandController;
use App\Http\Controllers\RefController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WedstrijdController;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

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

    // Team routes (teamleider)
    Route::get('/teams', [TeamLeiderController::class, 'index'])->name('teams.index');
    Route::post('/teams', [TeamLeiderController::class, 'store'])->name('team.store');
    Route::put('/teams/{team}', [TeamLeiderController::class, 'update'])->name('team.update');
    Route::delete('/teams/{team}', [TeamLeiderController::class, 'destroy'])->name('team.destroy');

    // Teamleider panel
    Route::get('/teamleider', [TeamLeiderController::class, 'index'])->name('teamleider');

    // Referee routes
    Route::get('/refpanel', [RefController::class, 'index'])->name('refpanel');
    Route::post('/scores', [RefController::class, 'store'])->name('scores.store');
});

// Cart routes
Route::post('/api/cart', [CartController::class, 'addToCart']);
Route::get('/api/cart', [CartController::class, 'getCartItems']);
Route::get('/winkelmand', [CartController::class, 'index']);

// Favorieten route
Route::get('/favorieten', [ProductController::class, 'favorieten'])->name('favorieten');

// Standings route
Route::get('/stand', [StandController::class, 'index'])->name('stand');

// Inzet route
Route::get('/inzet', function () {
    return view('inzet');
})->name('inzet');

// Admin routes
Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::put('/admin/users/{id}/rank', [AdminController::class, 'updateRank'])->name('admin.updateRank');
    Route::delete('/admin/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
});

// Wedstrijd routes
Route::middleware(['auth'])->group(function () {
    Route::get('wedstrijdmaker', [WedstrijdController::class, 'create'])->name('wedstrijdmaker'); // Nieuw wedstrijd toevoegen
    Route::post('wedstrijdmaker', [WedstrijdController::class, 'store'])->name('wedstrijden.store'); // Opslaan nieuwe wedstrijd

    // Bewerken en verwijderen van wedstrijden
    Route::get('wedstrijd/{id}/bewerken', [WedstrijdController::class, 'edit'])->name('wedstrijden.edit'); // Wedstrijd bewerken
    Route::put('wedstrijd/{id}', [WedstrijdController::class, 'update'])->name('wedstrijden.update'); // Update wedstrijd
    Route::delete('wedstrijd/{id}', [WedstrijdController::class, 'destroy'])->name('wedstrijden.destroy'); // Verwijder wedstrijd

    // Speelschema route
    Route::get('/speelschema', [WedstrijdController::class, 'speelschema'])->name('speelschema');
});

// Auth routes
require __DIR__.'/auth.php';
