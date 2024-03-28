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
use App\Http\Controllers\ReglementClController;
use App\Http\Controllers\ModeController;
use App\Http\Controllers\ReglementArtisanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/client', [ClientController::class, 'index'])->name('client.index');
Route::get('/ajouterclient', [ClientController::class, 'create'])->name('client.create');
Route::post('/client/store', [ClientController::class, 'store'])->name('client.store');
Route::delete('/client/{client}',[ ClientController::class,'destroy'])->name('client.destroy');


Route::get('/ventes', [VenteController::class, 'index'])->name('vente.index');
Route::get('/ventes/create', [VenteController::class, 'create'])->name('vente.create');
Route::post('/ventes', [VenteController::class, 'store'])->name('vente.store');
Route::get('/ventes/{vente}', [VenteController::class, 'show'])->name('vente.show');
Route::get('/ventes/{vente}/edit', [VenteController::class, 'edit'])->name('vente.edit');
Route::put('/ventes/{vente}', [VenteController::class, 'update'])->name('vente.update');
Route::delete('/ventes/{vente}', [VenteController::class, 'destroy'])->name('vente.destroy');


Route::get('/detailsvente', [DetailventeController::class, 'index'])->name('detailsvente.index');
Route::get('/detailsvente/create', [DetailventeController::class, 'create'])->name('detailsvente.create');
Route::post('/detailsvente/store', [DetailventeController::class, 'store'])->name('detailsvente.store');
Route::get('/detailsvente/{detailvente}', [DetailventeController::class, 'show'])->name('detailsvente.show');
Route::get('/detailsvente/{detailvente}/edit', [DetailventeController::class, 'edit'])->name('detailsvente.edit');
Route::put('/detailsvente/{detailvente}', [DetailventeController::class, 'update'])->name('detailsvente.update');
Route::delete('/detailsvente/{detailvente}', [DetailventeController::class, 'destroy'])->name('detailsvente.destroy');



Route::get('/artisan', [ArtisanController::class, 'index'])->name('artisan.index');
Route::get('/artisan/create', [ArtisanController::class, 'create'])->name('artisan.create');
Route::post('/artisan/store', [ArtisanController::class, 'store'])->name('artisan.store');
Route::get('/artisan/{artisan}', [ArtisanController::class, 'show'])->name('artisan.show');
Route::get('/artisan/{artisan}/edit', [ArtisanController::class, 'edit'])->name('artisan.edit');
Route::put('/artisan/{artisan}', [ArtisanController::class, 'update'])->name('artisan.update');
Route::delete('/artisan/{artisan}',[ ArtisanController::class,'destroy'])->name('artisan.destroy');


Route::get('/bonreseption', [BonreseptionController::class, 'index'])->name('bonreseption.index');
Route::get('/ajouterbonreseption', [BonreseptionController::class, 'create'])->name('bonreseption.create');
Route::post('/bonreseption/store', [BonreseptionController::class, 'store'])->name('bonreseption.store');
Route::delete('/bonreseption/{bonreception}',[ BonreseptionController::class,'destroy'])->name('bonreseption.destroy');


Route::get('/details', [DetailBrController::class, 'index'])->name('details.index');
Route::get('/details/create', [DetailBrController::class, 'create'])->name('details.create');
Route::post('/details/store', [DetailBrController::class, 'store'])->name('details.store');
Route::get('/details/{detail_Br}', [DetailBrController::class, 'show'])->name('details.show');
Route::get('/details/{detail_Br}/edit', [DetailBrController::class, 'edit'])->name('details.edit');
Route::put('/details/{detail_Br}', [DetailBrController::class, 'update'])->name('details.update');
Route::delete('/details/{detail}', [DetailBrController::class, 'destroy'])->name('details.destroy');

Route::get('/reglementCl', [ReglementClController::class, 'index'])->name('reglement_cl.index');

Route::get('/regArtisan', [ReglementArtisanController::class, 'index'])->name('reglement_artisan.index');


Route::get('/mode', [ModeController::class, 'index'])->name('mode.index');


Route::get('/familles', [FamilleController::class, 'index'])->name('familles.index');
Route::get('/create', [FamilleController::class, 'create'])->name('familles.create');
Route::post('/familles/store', [FamilleController::class, 'store'])->name('familles.store');
Route::delete('/familles/{famille}',[ FamilleController::class,'destroy'])->name('familles.destroy');

Route::get('/article', [ArticleController::class, 'index']);
Route::get('/ajouterarticle', [ArticleController::class, 'create'])->name('article.create');
Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');

Route::get('/sousfamille', [SousFamilleController::class, 'index'])->name('sousfamille.index');
Route::get('/ajoutersousfamille', [SousFamilleController::class, 'create'])->name('sous-familles.create');
Route::post('/sousfamille/store', [SousFamilleController::class, 'store'])->name('sous-familles.store');
Route::delete('/sousfamille/{sousFamille}',[ SousFamilleController::class,'destroy'])->name('sous-familles.destroy');


Route::get('/article', [ArticleController::class, 'index']);
Route::get('/ajouterarticle', [ArticleController::class, 'create'])->name('article.create');
Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');






use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;            
            

    Route::get('/dashboard', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::group(['middleware' => 'auth'], function () {
	//Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});