<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'ideas/', 'as' => 'ideas.', 'middleware' => ['auth']], function () {
    Route::post('', [IdeaController::class, 'store'])->name('store');
    Route::get('{idea}', [IdeaController::class, 'show'])->name('show')->withoutMiddleware(['auth']);
    Route::get('{idea}/edit', [IdeaController::class, 'edit'])->name('edit');
    Route::put('{idea}', [IdeaController::class, 'update'])->name('update');
    Route::delete('{idea}', [IdeaController::class, 'destroy'])->name('destroy');

    Route::post('{idea}/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::group(['prefix' => 'register/'], function () {
    Route::get('', [AuthController::class, 'register'])->name('register');
    Route::post('', [AuthController::class, 'store']);
});
Route::group(['prefix' => 'login/'], function () {
    Route::get('', [AuthController::class, 'login'])->name('login');
    Route::post('', [AuthController::class, 'authenticate']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');

Route::resource('users', UserController::class)->only('show', 'update', 'edit', 'update')->middleware(['auth']);

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

Route::get('/terms', function () {
    return view('terms');
});
