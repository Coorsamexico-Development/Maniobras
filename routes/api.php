<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\ListaAsitenciaController;
use App\Http\Controllers\Api\ManiobraController;
use App\Http\Controllers\Api\TurnoFechaController;
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


Route::post('login', [AuthenticationController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthenticationController::class, 'destroy']);
    Route::post('valid-token', [AuthenticationController::class, 'validToken']);

    Route::controller(ManiobraController::class)->group(function () {
        Route::get('/maniobras', 'index');
    });
    Route::get('/maniobras/{maniobra}/turno-fechas', [TurnoFechaController::class, 'index']);
    Route::get('/turno-fechas/{turnoFecha}/lista-asitencias', [ListaAsitenciaController::class, 'index']);
    Route::match(['put', 'post'], '/lista-asitencias/{listaAsitencia}', [ListaAsitenciaController::class, 'update']);
});
