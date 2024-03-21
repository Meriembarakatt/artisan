<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\FamilleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DetailventeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SousFamilleController;
use App\Http\Controllers\BonreseptionController;
use App\Http\Controllers\DetailBrController;
use App\Http\Controllers\VenteController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/client', [ClientController::class, 'index']);
Route::get('/ajouterclient', [ClientController::class, 'create'])->name('client.create');
Route::post('/client/store', [ClientController::class, 'store'])->name('client.store');

Route::get('/artisan', [ArtisanController::class, 'index'])->name('artisan.index');
Route::get('/ajouter', [ArtisanController::class, 'create'])->name('artisan.create');
Route::post('/artisan/store', [ArtisanController::class, 'store'])->name('artisan.store');

Route::get('/familles', [FamilleController::class, 'index'])->name('familles.index');
Route::get('/create', [FamilleController::class, 'create'])->name('familles.create');
Route::post('/familles/store', [FamilleController::class, 'store'])->name('familles.store');
Route::get('/article', [ArticleController::class, 'index']);
Route::get('/ajouterarticle', [ArticleController::class, 'create'])->name('article.create');
Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');

Route::get('/sousfamille', [SousFamilleController::class, 'index']);
Route::get('/ajoutersousfamille', [SousFamilleController::class, 'create'])->name('sous-familles.create');
Route::post('/sousfamille/store', [SousFamilleController::class, 'store'])->name('sous-familles.store');



Route::get('/bonreseption', [BonreseptionController::class, 'index']);
Route::get('/ajouterbonreseption', [BonreseptionController::class, 'create'])->name('bonreseption.create');
Route::post('/bonreseption/store', [BonreseptionController::class, 'store'])->name('bonreseption.store');



Route::get('/details', [DetailBrController::class, 'index'])->name('details.index');
Route::get('/details/create', [DetailBrController::class, 'create'])->name('details.create');
Route::post('/details/store', [DetailBrController::class, 'store'])->name('details.store');
Route::get('/details/{detail_Br}', [DetailBrController::class, 'show'])->name('details.show');
Route::get('/details/{detail_Br}/edit', [DetailBrController::class, 'edit'])->name('details.edit');
Route::put('/details/{detail_Br}', [DetailBrController::class, 'update'])->name('details.update');
Route::delete('/details/{detail_Br}', [DetailBrController::class, 'destroy'])->name('details.destroy');







Route::get('/detailsvente', [DetailventeController::class, 'index'])->name('detailsvente.index');
Route::get('/detailsvente/create', [DetailventeController::class, 'create'])->name('detailsvente.create');
Route::post('/detailsvente', [DetailventeController::class, 'store'])->name('detailsvente.store');
Route::get('/detailsvente/{detailvente}', [DetailventeController::class, 'show'])->name('detailsvente.show');
Route::get('/detailsvente/{detailvente}/edit', [DetailventeController::class, 'edit'])->name('detailsvente.edit');
Route::put('/detailsvente/{detailvente}', [DetailventeController::class, 'update'])->name('detailsvente.update');
Route::delete('/detailsvente/{detailvente}', [DetailventeController::class, 'destroy'])->name('detailsvente.destroy');




Route::get('/ventes', [VenteController::class, 'index'])->name('vente.index');
Route::get('/ventes/create', [VenteController::class, 'create'])->name('vente.create');
Route::post('/ventes', [VenteController::class, 'store'])->name('vente.store');
Route::get('/ventes/{vente}', [VenteController::class, 'show'])->name('vente.show');
Route::get('/ventes/{vente}/edit', [VenteController::class, 'edit'])->name('vente.edit');
Route::put('/ventes/{vente}', [VenteController::class, 'update'])->name('vente.update');
Route::delete('/ventes/{vente}', [VenteController::class, 'destroy'])->name('vente.destroy');



