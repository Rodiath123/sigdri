<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // logique de connexion à faire avec Rodiath
})->name('login.post');