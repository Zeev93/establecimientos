<?php

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Listado de API
Route::get('/establecimientos', [APIController::class, 'index'])->name('establecimiento.index');
Route::get('/establecimiento/{establecimiento}', [APIController::class, 'show'])->name('establecimiento.show');

Route::get('categorias', [APIController::class, 'categorias'])->name('categorias');
Route::get('categorias/{categoria}', [APIController::class, 'categoria'])->name('categoria');
Route::get('/{categoria}', [APIController::class, 'establecimientoscategoria'])->name('categoria');

