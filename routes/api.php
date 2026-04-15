<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UniteIndustrielleController;
use App\Http\Controllers\Api\CatalogueController;
use App\Http\Controllers\Api\DeclarationController;
use App\Http\Controllers\Api\AlerteMPController;

Route::post('/login',    [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    // Utilisateurs
    Route::get('/users',                       [UserController::class, 'index']);
    Route::get('/users/{id}',                  [UserController::class, 'show']);
    Route::post('/users',                      [UserController::class, 'store']);
    Route::put('/users/{id}',                  [UserController::class, 'update']);
    Route::patch('/users/{id}/desactiver',     [UserController::class, 'desactiver']);
    Route::patch('/users/{id}/activer',        [UserController::class, 'activer']);

    // Unités Industrielles
    Route::get('/unites',                      [UniteIndustrielleController::class, 'index']);
    Route::get('/unites/{id}',                 [UniteIndustrielleController::class, 'show']);
    Route::post('/unites',                     [UniteIndustrielleController::class, 'store']);
    Route::put('/unites/{id}',                 [UniteIndustrielleController::class, 'update']);
    Route::patch('/unites/{id}/desactiver',    [UniteIndustrielleController::class, 'desactiver']);
    Route::patch('/unites/{id}/activer',       [UniteIndustrielleController::class, 'activer']);

    // Produits
    Route::get('/produits',                    [CatalogueController::class, 'indexProduits']);
    Route::get('/produits/{id}',               [CatalogueController::class, 'showProduit']);
    Route::post('/produits',                   [CatalogueController::class, 'storeProduit']);
    Route::put('/produits/{id}',               [CatalogueController::class, 'updateProduit']);
    Route::patch('/produits/{id}/desactiver',  [CatalogueController::class, 'desactiverProduit']);
    Route::patch('/produits/{id}/activer',     [CatalogueController::class, 'activerProduit']);

    // Matières Premières
    Route::get('/matieres-premieres',                   [CatalogueController::class, 'indexMatierePremieres']);
    Route::get('/matieres-premieres/{id}',              [CatalogueController::class, 'showMatierePremiere']);
    Route::post('/matieres-premieres',                  [CatalogueController::class, 'storeMatierePremiere']);
    Route::put('/matieres-premieres/{id}',              [CatalogueController::class, 'updateMatierePremiere']);
    Route::patch('/matieres-premieres/{id}/desactiver', [CatalogueController::class, 'desactiverMatierePremiere']);
    Route::patch('/matieres-premieres/{id}/activer',    [CatalogueController::class, 'activerMatierePremiere']);

    // Déclarations
    Route::get('/declarations',                [DeclarationController::class, 'index']);
    Route::get('/declarations/{id}',           [DeclarationController::class, 'show']);
    Route::post('/declarations',               [DeclarationController::class, 'store']);
    Route::post('/declarations/sync',          [DeclarationController::class, 'sync']);
    Route::patch('/declarations/{id}/valider', [DeclarationController::class, 'valider']);
    Route::patch('/declarations/{id}/rejeter', [DeclarationController::class, 'rejeter']);

    // Alertes MP
    Route::get('/alertes-mp',                  [AlerteMPController::class, 'index']);
    Route::get('/alertes-mp/{id}',             [AlerteMPController::class, 'show']);
    Route::post('/alertes-mp',                 [AlerteMPController::class, 'store']);
    Route::patch('/alertes-mp/{id}/traiter',   [AlerteMPController::class, 'traiter']);
});