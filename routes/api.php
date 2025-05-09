<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CategoriaServicioController;
use App\Http\Controllers\API\EquipoController;
use App\Http\Controllers\API\HistoriaController;
use App\Http\Controllers\API\ImagenController;
use App\Http\Controllers\API\InfoContactoController;
use App\Http\Controllers\API\MantenimientoInfoController;
use App\Http\Controllers\API\PreguntaFrecuenteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('categorias-servicio', CategoriaServicioController::class);
Route::apiResource('equipos', EquipoController::class);
Route::apiResource('historias', HistoriaController::class);
Route::apiResource('imagenes', ImagenController::class);
Route::apiResource('info-contacto', InfoContactoController::class);
Route::apiResource('mantenimiento-info', MantenimientoInfoController::class);
Route::apiResource('preguntas-frecuentes', PreguntaFrecuenteController::class);

Route::get('/wea', function () {
    return response()->json([
        'message' => 'Hello, World!'
    ]);
});