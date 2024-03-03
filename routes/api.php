<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\apisController;
use App\Http\Controllers\AsistenciaControlle;
use App\Http\Controllers\EmpleadoControlle;
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

//Route::apiResource('entradas',ApiController::class);
Route::post('entrada', [ApiController::class, 'GuardaAsistencia'])->name('api.entrada');
Route::post('assistencia',[ApiController::class,'GuardaSalida'])->name('api.salida');

Route::post('reportes',[ApiController::class,'Mostrarfecha'])->name('api.reportes');