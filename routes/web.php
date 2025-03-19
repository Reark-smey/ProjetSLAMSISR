<?php


use App\Http\Controllers\ClassementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
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

Route::get('/message', [ApiController::class, 'getMessage']);

Route::get('ChoisirGrandClient', [\App\Http\Controllers\ClassementController::class,'ChoisirLeCLient'])->name('ChoisirGrandClient');
Route::post('/validerChoixGrandClient', [ClassementController::class,'validerChoixGrandClient'])->name('validerChoixGrandClient');
Route::get('/ListerClassement/{id}',[ClassementController::class,'ListerClassement'])->name('ListerClassement');

Route::get('/ListerTopFive', 'App\Http\Controllers\ClassementController@ListerTopFive');
Route::get('/ListerProduitOneFour', 'App\Http\Controllers\ClassementController@ListerProduitOneFour');
Route::get('/ListerProduitOneOne', 'App\Http\Controllers\ClassementController@ListerProduitOneOne');

