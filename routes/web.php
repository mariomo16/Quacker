<?php

use App\Http\Controllers\QuacksController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/quacks');
});

Route::resource('quacks', QuacksController::class);
Route::resource('users', UserController::class);