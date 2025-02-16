<?php

use App\Http\Controllers\BadgesLibresController;
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



Route::get('/ajouterEmploye', function () {return view('vues/formEmploye');});

Route::post('/postEmploye', 'App\Http\Controllers\EmployeController@postAjouterEmploye');
Route::get('/listerEmploye', 'App\Http\Controllers\EmployeController@listerEmployes');

Route::get('/modifierEmploye/{id}', 'App\Http\Controllers\EmployeController@modifier');
Route::post('/postmodifierEmploye/{id}', 'App\Http\Controllers\EmployeController@postmodifier');

Route::get('/ajoutEquipe', function () {return view('vues/FormEquipe');});

Route::post('/postEquipe', 'App\Http\Controllers\EquipeController@postAjouterEquipe');
Route::get('/listerEquipe', 'App\Http\Controllers\EquipeController@listerEquipe');

Route::get('/modifierEquipe/{id}', 'App\Http\Controllers\EquipeController@modifierEquipe');
Route::post('/postmodifierEquipe/{id}', 'App\Http\Controllers\EquipeController@postmodifierEquipe');


