<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StepsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', fn () => redirect('/ideas'))->name('home');
Route::get('/about', fn () => view('about'))->name('about');

// Ideas routes - index first, then specific routes
Route::get('/ideas', [IdeaController::class, 'index'])->middleware('auth')->name('ideas.index');
Route::get('/ideas/create', [IdeaController::class, 'create'])->middleware('auth')->name('ideas.create');
Route::post('/ideas', [IdeaController::class, 'store'])->middleware('auth')->name('ideas.store');

// Specific idea routes
Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->middleware('auth')->name('ideas.show');
Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->middleware('auth')->name('ideas.edit');
Route::put('/ideas/{idea}', [IdeaController::class, 'update'])->middleware('auth')->name('ideas.update');
Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->middleware('auth')->name('ideas.destroy');

Route::patch('/steps/{step}', [StepsController::class, 'update'])
    ->name('steps.update')
    ->middleware('auth');

// Comment routes
Route::post('/ideas/{idea}/comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy')
    ->middleware('auth');

// Like routes
Route::post('/ideas/{idea}/like', [LikeController::class, 'toggle'])
    ->name('ideas.like')
    ->middleware('auth');

// User profile routes
Route::get('/users/{user}', [UserController::class, 'show'])->name('profiles.show');
Route::get('/profile/edit', [UserController::class, 'edit'])->middleware('auth')->name('profiles.edit');
Route::put('/profile', [UserController::class, 'update'])->middleware('auth')->name('profiles.update');

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest')->name('register.store');

Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest')->name('login.store');
Route::delete('/logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::post('/users/{user}/change-role', [AdminController::class, 'changeUserRole'])->name('admin.users.changeRole');
    Route::post('/users/{user}/ban', [AdminController::class, 'banUser'])->name('admin.users.ban');
    Route::post('/users/{user}/unban', [AdminController::class, 'unbanUser'])->name('admin.users.unban');
    
    Route::get('/ideas', [AdminController::class, 'ideas'])->name('admin.ideas.index');
    Route::delete('/ideas/{idea}', [AdminController::class, 'deleteIdea'])->name('admin.ideas.destroy');
    
    Route::get('/comments', [AdminController::class, 'comments'])->name('admin.comments.index');
    Route::delete('/comments/{comment}', [AdminController::class, 'deleteComment'])->name('admin.comments.destroy');
    
    Route::get('/flags', [AdminController::class, 'flags'])->name('admin.flags.index');
    Route::post('/flags/{flag_id}/resolve', [AdminController::class, 'resolveFlag'])->name('admin.flags.resolve');
    Route::post('/flags/{flag_id}/dismiss', [AdminController::class, 'dismissFlag'])->name('admin.flags.dismiss');
});

