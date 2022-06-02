<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Gestion\DocumentosController;
use App\Http\Controllers\Catalogos\PuestosController;
use App\Http\Controllers\Catalogos\AdscripcionesController;
use App\Http\Controllers\Catalogos\PersonalController;

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Rutas de Documentos
Route::get('documentos/index',    [DocumentosController::class, 'index'])->name('documentos.index');
Route::get('documentos/nuevo',    [DocumentosController::class, 'nuevo_documento']);

//Rutas de Puestos
Route::get('puestos/index',       [PuestosController::class, 'index'])->name('puestos.index');
Route::get('puestos/nuevo',       [PuestosController::class, 'nuevo_puesto']);
Route::post('puestos/guardar',    [PuestosController::class, 'guardar_puesto']);

//Rutas de Adscripciones
Route::get('adscripciones/index', [AdscripcionesController::class, 'index'])->name('adscripciones.index');

//Rutas de Personal
Route::get('personal/index',      [PersonalController::class, 'index'])->name('personal.index');
