<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReviewController;
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

Route::get('bookmarks', [BookmarkController::class, 'getByUser'])->name('bookmarks');

Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/', [PlaceController::class, 'index'])->name('home');

Route::resource('report', ContactController::class, ['only' => ['create', 'store']]);

Route::get('/place/create', [PlaceController::class, 'create'])->name('place.create');
Route::post('/place', [PlaceController::class, 'store'])->name('place.store');

Route::get('bookmark/{place_id}', [BookmarkController::class, 'bookmark'])->name('bookmark');
Route::get('/{place}/{slug}', [PlaceController::class, 'show'])->name('place.show');

Route::post('review', [ReviewController::class, 'store'])->name('review.store');
Route::post('like', [LikeController::class, 'store'])->name('like.store');
