<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HistoricController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\BrandController;
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

Route::get('/storico', [HistoricController::class, 'index']);
Route::get('/magazzino', [WarehouseController::class, 'index']);
Route::get('/negozio', [ShopController::class, 'index']);
Route::delete('/negozio/{id}', [ShopController::class, 'destroy']);
Route::delete('/magazzino/{id}', [WarehouseController::class, 'destroy']);
Route::post('/magazzino/{id}', [WarehouseController::class, 'sposta']);
Route::get('/aggiungiArticolo', [ArticleController::class, 'create']);
Route::post('/aggiungiArticolo', [ArticleController::class, 'store']);
Route::get('/aggiungiTipologia',[TypeController::class, 'create']);
Route::post('/aggiungiTipologia',[TypeController::class, 'store']);
Route::get('/aggiungiMarca',[BrandController::class, 'create']);
Route::post('/aggiungiMarca',[BrandController::class, 'store']);
Route::put('/negozio/{id}', [ShopController::class, 'venduto']);
