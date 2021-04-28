<?php

use App\Http\Controllers\ArticoloController;
use App\Http\Controllers\StoricoController;
use App\Http\Controllers\MagazzinoController;
use App\Http\Controllers\NegozioController;
use App\Http\Controllers\TipologiaController;
use App\Http\Controllers\MarcaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Homepage');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/storico', [StoricoController::class, 'index']);
Route::get('/magazzino', [MagazzinoController::class, 'index']);
Route::get('/negozio', [NegozioController::class, 'index']);
Route::delete('/negozio/{id}', [NegozioController::class, 'destroy']);
Route::delete('/magazzino/{id}', [MagazzinoController::class, 'destroy']);
Route::post('/magazzino/{id}', [MagazzinoController::class, 'sposta']);
Route::get('/aggiungiArticolo', [ArticoloController::class, 'create']);
Route::post('/aggiungiArticolo', [ArticoloController::class, 'store']);
Route::get('/aggiungiTipologia',[TipologiaController::class, 'create']);
Route::post('/aggiungiTipologia',[TipologiaController::class, 'store']);
Route::get('/aggiungiMarca',[MarcaController::class, 'create']);
Route::post('/aggiungiMarca',[MarcaController::class, 'store']);
