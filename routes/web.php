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
use App\Http\Controllers\TeamController;
use App\Livewire\Dashboard;

Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
})->name('home');
Route::get('/about', fn () => view('about'))->name('about');

// Public Pages
Route::get('/resources', fn () => view('resources'))->name('resources');
Route::get('/documentation', fn () => view('documentation'))->name('documentation');
Route::get('/community-guidelines', fn () => view('community-guidelines'))->name('community-guidelines');
Route::get('/privacy-policy', fn () => view('privacy-policy'))->name('privacy-policy');
Route::get('/terms-of-service', fn () => view('terms-of-service'))->name('terms-of-service');

// Dashboard - Main single-page application
Route::get('/dashboard', Dashboard::class)->middleware('auth')->name('dashboard');

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

// Team routes
Route::middleware('auth')->group(function () {
    Route::resource('teams', TeamController::class);
    Route::post('/teams/{team}/members', [TeamController::class, 'addMember'])->name('teams.addMember');
    Route::delete('/teams/{team}/members/{user}', [TeamController::class, 'removeMember'])->name('teams.removeMember');
    Route::post('/teams/{team}/share-idea/{idea}', [TeamController::class, 'shareIdea'])->name('teams.shareIdea');
    Route::delete('/teams/{team}/unshare-idea/{idea}', [TeamController::class, 'unshareIdea'])->name('teams.unshareIdea');
});

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

