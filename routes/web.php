<?php

use App\Http\Controllers\DogsController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/dogs/list', [DogsController::class, 'index'])->name('dogs.index');
    Route::post('/dogs/add-to-favorite', [DogsController::class, 'addToFavorite'])->name('dogs.add-to-favorite');
    Route::post('/dogs/remove-to-favorite', [DogsController::class, 'removeToFavorite'])->name('dogs.remove-to-favorite');

    Route::get('/dogs/favorite', [FavoritesController::class, 'index'])->name('favorite.index');

    Route::get('/dogs/favorite/{favorite}/edit', [FavoritesController::class, 'edit'])->name('favorite.edit');
    Route::delete('/dogs/favorite/{favorite}/delete', [FavoritesController::class, 'delete'])->name('favorite.delete');

    // Route::get('/dogs/breed', [DogsController::class, 'showDogs'])->name('dogs.show');
});

require __DIR__ . '/auth.php';
