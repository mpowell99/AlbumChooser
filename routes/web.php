<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AlbumController::class, 'index'])->name('home');

Route::get('album/{album}', [AlbumController::class, 'show'])->name('album');

Route::get('listen/{album}', [AlbumController::class, 'listen'])->name('album.listen');

Route::get('choose/', [AlbumController::class, 'choose'])->name('choose');

Route::get('search', [AlbumController::class, 'search'])->name('search');

Route::get('artist/{artist}', [ArtistController::class, 'show'])->name('artist');

Route::get('artists/', [ArtistController::class, 'index'])->name('artists');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
