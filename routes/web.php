<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Gestion\DocumentosController;
use App\Http\Controllers\Gestion\DestinatarioAtencionController;
use App\Http\Controllers\Gestion\DestinatarioConocimientoController;
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
Route::get('documentos/index',                      [DocumentosController::class, 'index'])->name('documentos.index');
Route::get('documentos/nuevo',                      [DocumentosController::class, 'nuevo_documento']);
Route::post('documentos/guardar',                   [DocumentosController::class, 'guardar_documento']);
Route::get('documentos/editar/{id_documento}',      [DocumentosController::class, 'editar_documento'])->name('documentos.editar');
Route::post('documentos/actualizar',                [DocumentosController::class, 'actualizar_documento']);
Route::get('documentos/inhabilitar/{id_documento}', [DocumentosController::class, 'confirmainhabilitar_documento']);
Route::post('documentos/inhabilitar',               [DocumentosController::class, 'inhabilitar_documento']);
Route::post('buscaDoctoDuplicado',                  [DocumentosController::class, 'buscaDoctoDuplicado']);


//Rutas de Destinatarios Atención
Route::post('destatencion/seguimiento',             [DestinatarioAtencionController::class, 'seguimiento']);

//Rutas de Destinatarios Conocimiento
Route::post('destconoc/seguimiento',                [DestinatarioConocimientoController::class, 'seguimiento']);

//Rutas de Puestos
Route::get('puestos/index',                         [PuestosController::class, 'index'])->name('puestos.index');
Route::get('puestos/nuevo',                         [PuestosController::class, 'nuevo_puesto']);
Route::post('puestos/guardar',                      [PuestosController::class, 'guardar_puesto']);
Route::get('puestos/editar/{id_puesto}',            [PuestosController::class, 'editar_puesto']);
Route::post('puestos/actualizar',                   [PuestosController::class, 'actualizar_puesto']);
Route::get('puestos/inhabilitar/{id_puesto}',       [PuestosController::class, 'confirmainhabilitar_puesto']);

//Rutas de Adscripciones
Route::get('adscripciones/index',                   [AdscripcionesController::class, 'index'])->name('adscripciones.index');
Route::get('adscripciones/nueva',                   [AdscripcionesController::class, 'nueva_adscripcion']);
Route::post('adscripciones/guardar',                [AdscripcionesController::class, 'guardar_adscripcion']);
Route::get('adscripciones/editar/{id_adsc}',        [AdscripcionesController::class, 'editar_adscripcion']);
Route::post('adscripciones/actualizar',             [AdscripcionesController::class, 'actualizar_adscripcion']);
Route::get('adscripciones/inhabilitar/{id_adsc}',   [AdscripcionesController::class, 'confirmainhabilitar_adscripcion']);

//Rutas de Personal
Route::get('personal/index',                        [PersonalController::class, 'index'])->name('personal.index');
Route::get('personal/nuevo',                        [PersonalController::class, 'nuevo_personal']);
Route::post('personal/guardar',                     [PersonalController::class, 'guardar_personal']);
Route::get('personal/editar/{id_personal}',         [PersonalController::class, 'editar_personal']);
Route::post('personal/actualizar',                  [PersonalController::class, 'actualizar_personal']);
Route::get('personal/inhabilitar/{id_personal}',    [PersonalController::class, 'confirmainhabilitar_personal']);
Route::post('buscaPuestoAdscrip',                   [PersonalController::class, 'buscaPuestoAdscrip']);
