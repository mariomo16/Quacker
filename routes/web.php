<?php

use App\Http\Controllers\QuacksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/quacks');
});

Route::resource('quacks', QuacksController::class);