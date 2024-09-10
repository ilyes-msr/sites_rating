<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/search', [SearchController::class, 'search'])->name('auto-complete');
Route::post('/search', [SearchController::class, 'show'])->name('search');

Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/', [PlaceController::class, 'index'])->name('home');
