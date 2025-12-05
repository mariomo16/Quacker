<?php

use App\Http\Controllers\QuackController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/quacks');
});

Route::resource('quacks', QuackController::class);
Route::resource('users', UserController::class);
