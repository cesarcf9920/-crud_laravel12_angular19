<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ProyectoController;

Route::apiResource('trabajadores', TrabajadorController::class);
Route::get('proyectos', [TrabajadorController::class, 'proyectos']);
Route::get('cargos', [TrabajadorController::class, 'cargos']);
Route::get('tipos_pagos', [TrabajadorController::class, 'tiposPagos']);
Route::get('tipos_cambios', [TrabajadorController::class, 'tiposCambios']);

Route::apiResource('proyectos', ProyectoController::class);
Route::apiResource('cargos', CargoController::class);

