<?php

use App\Models\Quack;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quacks', function () {
    return Quack::get(); // Esto devolverá un JSON con todos los quacks
});