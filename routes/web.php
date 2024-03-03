<?php

use App\Http\Controllers\AsistenciaControlle;
use App\Http\Controllers\EmpleadoControlle;
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
    return view('asistencia');
});

Route::get('/laravel', function () {
    return view('welcome');
});
Route::get('/admin',function(){
    return view('administra.admin');
});
Route::get('reporte',[AsistenciaControlle::class,'index']);

Route::post('reporte',[AsistenciaControlle::class,'Mostrarfecha']);
Route::get('/empleado', [EmpleadoControlle::class, 'index']);
