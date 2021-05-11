<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HistoricController;
use App\Http\Controllers\LogisticController;
use App\Models\Logistic;
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

Route::get('/magazzino', [LogisticController::class, 'magazzino']);
Route::get('/ricerca/{location}', [LogisticController::class, 'ricerca']);
Route::get('/ricerca/{location}/risultato', function () {
    return view('Ricerca');
});
Route::get('/negozio', [LogisticController::class, 'negozio']);
Route::get('/newarticoli', [LogisticController::class, 'create']);
Route::post('/newarticoli', [LogisticController::class, 'store']);
Route::put('/newarticoli', [LogisticController::class, 'newcode']);
Route::get('/elimina/{id}/{quantita}', [LogisticController::class, 'delete']);
Route::delete('/elimina/{id}/{quantita}', [LogisticController::class, 'destroy']);
Route::get('/sposta/{id}/{quantita}', [LogisticController::class, 'move']);
Route::post('/sposta/{id}/{quantita}', [LogisticController::class, 'sposta']);
