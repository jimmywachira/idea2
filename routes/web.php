<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/ideas'))->name('home');
Route::get('/about', fn () => view('about'))->name('about');

Route::get('/ideas', [IdeaController::class, 'index'])->middleware('auth')->name('ideas.index');
Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->middleware('auth')->name('ideas.show');
Route::get('/ideas/create', [IdeaController::class, 'create'])->middleware('auth')->name('ideas.create');
Route::post('/ideas', [IdeaController::class, 'store'])->middleware('auth')->name('ideas.store');   
// Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->middleware('auth')->name('ideas.edit');
// Route::put('/ideas/{idea}', [IdeaController::class, 'update'])->middleware('auth')->name('ideas.update');
Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->middleware('auth')->name('ideas.destroy');

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest')->name('register.store');

Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest')->name('login.store');
Route::delete('/logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
