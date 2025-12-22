<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuackController;
use App\Http\Controllers\QuashtagController;

Route::get('/', function () {
    return redirect('/quacks');
});

// Rutas para invitados (no autenticados)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'create'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

});

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('quacks', QuackController::class);
    Route::resource('users', UserController::class);
    Route::resource('quashtags', QuashtagController::class);
});
