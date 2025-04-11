<?php

use App\Http\Controllers\TurnoController;
use App\Http\Controllers\RegistroController;


Route::get('/turnos', [TurnoController::class, 'index'])->name('turnos.index');


Route::post('/turnos', [TurnoController::class, 'store']);
Route::put('/turnos/{turno}', [TurnoController::class, 'update']);
Route::delete('/turnos/{turno}', [TurnoController::class, 'destroy']);
Route::get('/turnos/{turno}', [TurnoController::class, 'show']);

Route::post('/registro', [RegistroController::class, 'store']);
Route::get('/registros', [RegistroController::class, 'filtrar']);


Route::get('/registros/{id}', [RegistroController::class, 'show']);
Route::put('/registros/{id}', [RegistroController::class, 'update']);
Route::delete('/registros/{id}', [RegistroController::class, 'destroy']);
