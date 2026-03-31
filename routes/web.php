<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // logique de connexion à faire avec Rodiath
})->name('login.post');

Route::get('/declarations', function () {
    return view('declarations.index');
})->name('declarations.index');

Route::get('/unites', function () {
    return view('unites.index');
})->name('unites.index');

Route::get('/produits', function () {
    return view('produits.index');
})->name('produits.index');

Route::get('/statistiques', function () {
    return view('statistiques.index');
})->name('statistiques.index');

Route::get('/rapports', function () {
    return view('rapports.index');
})->name('rapports.index');

Route::get('/alertes', function () {
    return view('alertes.index');
})->name('alertes.index');

Route::get('/utilisateurs', function () {
    return view('utilisateurs.index');
})->name('utilisateurs.index');

Route::get('/parametrage', function () {
    return view('parametrage.index');
})->name('parametrage.index');

Route::get('/profil', function () {
    return view('profil');
})->name('profil');