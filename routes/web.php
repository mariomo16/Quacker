<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuackController;
use App\Http\Controllers\QuashtagController;

Route::get('/', function () {
    return redirect('/quacks');
});

Route::resource('users', UserController::class);
Route::resource('quacks', QuackController::class);
Route::resource('quashtags', QuashtagController::class);
