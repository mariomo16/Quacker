<?php

use App\Http\Controllers\QuackController;
use App\Http\Controllers\QuashtagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
use Illuminate\Support\Facades\Route;

// Rutas para invitados (no autenticados)
Route::middleware('guest')->group(function () {
    Route::redirect('/', 'login');

    Route::get('/register', [AuthController::class, 'create'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

});

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::redirect('/', 'feed');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/feed', [FeedController::class, 'feed'])->name('feed');

    Route::resource('quacks', QuackController::class)->except('create');

    Route::get('/quashtags/{quashtag}/quacks', [QuackController::class, 'quashtagQuacks'])->name('quashtag.quacks');
    Route::resource('quashtags', QuashtagController::class)->only('index');

    Route::get('/users/edit', [UserController::class, 'editMe'])->name('editMe');
    Route::get('/users/{id}/quacks', [QuackController::class, 'userQuacks'])->name('user.quacks');
    Route::resource('users', UserController::class)->only(['index', 'show', 'update']);
});
