<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BadgesLibresController;
use App\Http\Controllers\MembreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home'); });

Route::get('/formLogin', 'App\Http\Controllers\ControllerLogin@getLogin');

Route::post('/login', 'App\Http\Controllers\ControllerLogin@signIn');

Route::get('/logout', 'App\Http\Controllers\ControllerLogin@signOut');

Route::get('/listerAdherents', 'App\Http\Controllers\AdminController@listerAdherents');

Route::get('/DroitsGolfClou', 'App\Http\Controllers\AdminController@listerAdherentsClou');
Route::get('/DroitsGolfGouverneur', 'App\Http\Controllers\AdminController@listerAdherentsGouverneur');
Route::get('/DroitsGolfBeaujolais', 'App\Http\Controllers\AdminController@listerAdherentsBeaujolais');

Route::get('selGolf', [\App\Http\Controllers\BadgesLibresController::class,'listerGolf'])->name('selGolf');
Route::post('/validerGolf', [BadgesLibresController::class,'validerGolf'])->name('postGolf');
Route::get('/listerBadgesLibresByGolf/{id}',[BadgesLibresController::class,'listerBadgesLibresByGolf'])->name('golf');

Route::get('listerBadgesRecuperer', 'App\Http\Controllers\BadgesLibresController@listerBadgesRecuperer');

Route::get('AjouterAdherent', [\App\Http\Controllers\AdminController::class,'AjouterAdherent'])->name('AddAdherent');
Route::post('/validerAdherent', [AdminController::class,'validerAdherent'])->name('validerAdherent');

Route::get('/modifierAdherent/{id}', [AdminController::class,'modifierAdherent'])->name('UpdateAdherent');

Route::get('supprimerAdherent/{id}', [AdminController::class, 'supprimerAdherent'])->name('delAdherent');

Route::get('ajouterAutorisation', [AdminController::class,'ajouterAutorisation'])->name('ajouterAutorisation');
Route::post('/validerAutorisation', [AdminController::class,'validerAutorisation'])->name('validerAutorisation');

Route::get('ChoisirAdherent', [AdminController::class,'ChoisirAdherent'])->name('ChoisirAdherent');
Route::post('/validerChoixAdherent', [AdminController::class,'validerChoixAdherent'])->name('validerChoixAdherent');

Route::get('/AjouterBadge', [AdminController::class,'AjouterBadge'])->name('AjouterBadge');
Route::post('/validerAjoutBadge', [AdminController::class,'validerAjoutBadge'])->name('validerAjoutBadge');


route::get('ReserverBadgeLibre/{id}', [BadgesLibresController::class,'ReserverBadgeLibre'])->name('ReserverBadgeLibre');
Route::get('listerGolfAuth', [\App\Http\Controllers\BadgesLibresController::class,'listerGolfAuth'])->name('listerGolfAuth');


Route::get('/InfoMembre', [MembreController::class,'InfoMembre'])->name('InfoMembre');
Route::get('/ProfilMembre/{id}', [MembreController::class,'ProfilMembre'])->name('ProfilMembre');

Route::post('/validerBadgeLibre', [BadgesLibresController::class,'validerBadgeLibre'])->name('validerBadgeLibre');

Route::get('/LibererUnBadge', [BadgesLibresController::class,'LibererUnBadge'])->name('LibererUnBadge');
Route::post('/validerLibererBadgeLibre', [BadgesLibresController::class,'validerLibererBadgeLibre'])->name('validerLibererBadgeLibre');


Route::get('/MesBadges', [MembreController::class,'MesBadges'])->name('MesBadges');
