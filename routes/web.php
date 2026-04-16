<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\StatistiqueController;
use App\Http\Controllers\Web\RapportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Routes d'authentification
Auth::routes();

// Routes protégées
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Unités Industrielles
    Route::resource('unites', \App\Http\Controllers\UniteIndustrielleController::class);
    Route::patch('/unites/{id}/toggle', [\App\Http\Controllers\UniteIndustrielleController::class, 'toggle'])->name('unites.toggle');

    // Produits
    Route::resource('produits', \App\Http\Controllers\ProduitController::class);
    Route::patch('/produits/{id}/toggle', [\App\Http\Controllers\ProduitController::class, 'toggle'])->name('produits.toggle');

    // Matières Premières
    Route::resource('matieres-premieres', \App\Http\Controllers\MatierePremiereController::class);
    Route::patch('/matieres-premieres/{id}/toggle', [\App\Http\Controllers\MatierePremiereController::class, 'toggle'])->name('matieres-premieres.toggle');

    // Utilisateurs
    Route::resource('utilisateurs', \App\Http\Controllers\UserController::class);
    Route::patch('/utilisateurs/{id}/toggle', [\App\Http\Controllers\UserController::class, 'toggle'])->name('utilisateurs.toggle');

    // Déclarations
    Route::get('/declarations', [\App\Http\Controllers\DeclarationController::class, 'indexWeb'])->name('declarations.index');
    Route::get('/declarations/{id}', [\App\Http\Controllers\DeclarationController::class, 'showWeb'])->name('declarations.show');
    Route::patch('/declarations/{id}/valider', [\App\Http\Controllers\DeclarationController::class, 'validerWeb'])->name('declarations.valider');
    Route::patch('/declarations/{id}/rejeter', [\App\Http\Controllers\DeclarationController::class, 'rejeterWeb'])->name('declarations.rejeter');

    // Alertes
    Route::get('/alertes', [\App\Http\Controllers\AlerteMPController::class, 'indexWeb'])->name('alertes.index');
    Route::patch('/alertes/{id}/traiter', [\App\Http\Controllers\AlerteMPController::class, 'traiterWeb'])->name('alertes.traiter');

    // Statistiques
    Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');
    Route::get('/statistiques/data', [StatistiqueController::class, 'getData'])->name('statistiques.data');

    // Rapports (version corrigée - sans doublons)
    Route::get('/rapports', [RapportController::class, 'index'])->name('rapports.index');
    Route::post('/rapports/generate-pdf', [RapportController::class, 'generatePDF'])->name('rapports.pdf');
    Route::post('/rapports/generate-excel', [RapportController::class, 'generateExcel'])->name('rapports.excel');

    // Profil
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');

    // Parametrage
    Route::get('/parametrage', [App\Http\Controllers\Web\ParametrageController::class, 'index'])->name('parametrage.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');