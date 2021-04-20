<?php

use App\Http\Controllers\StoricoController;
use App\Http\Controllers\MagazzinoController;
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
Route::get('/gestione', [MagazzinoController::class, 'index']);
Route::delete('/gestione/{id}', [MagazzinoController::class, 'destroy']);
