<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\SetLocaleMiddleware;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

Route::get('lang/{lang}', function ($lang = 'en') {
    app()->setLocale($lang);
    session()->put('locale', $lang);

    return redirect()->route('dashboard');
})->name('lang');

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
    Route::get('', [AuthController::class, 'register'])->middleware('guest')->name('register');
    Route::post('', [AuthController::class, 'store'])->middleware('guest');
});
Route::group(['prefix' => 'login/'], function () {
    Route::get('', [AuthController::class, 'login'])->middleware('guest')->name('login');
    Route::post('', [AuthController::class, 'authenticate'])->middleware('guest');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');

Route::resource('users', UserController::class)->only('show');
Route::resource('users', UserController::class)->only('update', 'edit', 'update')->middleware(['auth']);

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])->middleware('auth')->name('ideas.like');
Route::post('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])->middleware('auth')->name('ideas.unlike');

Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');


Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::middleware(['auth'])->prefix('admin/')->as('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/ideas', [AdminIdeaController::class, 'index'])->name('ideas');
    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments');
    Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
});
