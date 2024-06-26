<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Gestion\DocumentosController;
use App\Http\Controllers\Gestion\DestinatarioAtencionController;
use App\Http\Controllers\Gestion\DestinatarioConocimientoController;
use App\Http\Controllers\Gestion\FolioRelacionadoController;
use App\Http\Controllers\Gestion\PersonalConocimientoController;
use App\Http\Controllers\Gestion\ReportesController;
use App\Http\Controllers\Catalogos\PuestosController;
use App\Http\Controllers\Catalogos\AdscripcionesController;
use App\Http\Controllers\Catalogos\PersonalController;
use App\Http\Controllers\Catalogos\UsuariosController;

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
Route::get('documentos/acuse/{id_documento}',       [DocumentosController::class, 'acuse_documento']);
Route::get('documentos/editar/{id_documento}',      [DocumentosController::class, 'editar_documento'])->name('documentos.editar');
Route::post('documentos/actualizar',                [DocumentosController::class, 'actualizar_documento']);
Route::get('documentos/inhabilitar/{id_documento}', [DocumentosController::class, 'confirmainhabilitar_documento']);
Route::post('documentos/inhabilitar',               [DocumentosController::class, 'inhabilitar_documento']);
Route::post('buscaDoctoDuplicado',                  [DocumentosController::class, 'buscaDoctoDuplicado']);
//Ruta de Folios Duplicados
Route::post('buscaFolioDuplicado',                  [DocumentosController::class, 'buscaFolioDuplicado']);
//Ruta para Completar Folios a 5 dígitos con ceros a la izquierda
Route::get('documentos/completar',                  [DocumentosController::class, 'completarFolios']);
Route::get('documentos/exportar',                   [DocumentosController::class, 'export']);

//Rutas de Reportes
Route::get('reportes/param_estadistico',            [ReportesController::class, 'param_estadistico']);
Route::get('reportes/estadistico',                  [ReportesController::class, 'reporte_estadistico']);
Route::get('reportes/param_sireo',                  [ReportesController::class, 'param_sireo']);
Route::get('reportes/estadistico_sireo',            [ReportesController::class, 'reporte_sireo']);
Route::get('reportes/param_consulta',               [ReportesController::class, 'param_consulta']);
Route::get('reportes/consulta_estadistica',         [ReportesController::class, 'consulta_estadistica']);
Route::get('reportes/param_pendientes',             [ReportesController::class, 'param_pendientes'])->name('reportes.param_pendientes');
Route::get('reportes/consulta_pendientes',          [ReportesController::class, 'consulta_pendientes']);
Route::get('reportes/param_exportar',               [ReportesController::class, 'param_exportar']);

//Rutas de Folios Relacionados
Route::get('folios/nuevo/{id_documento}',           [FolioRelacionadoController::class, 'nuevo_folio']);
Route::post('folios/guardar',                       [FolioRelacionadoController::class, 'guarda_nuevo_folio_rel']);
Route::get('folios/inhabilitar/{id_documento}/{id_foliorel}',     [FolioRelacionadoController::class, 'confirmainhabilitar_folio']);
Route::post('folios/inhabilitar',                   [FolioRelacionadoController::class, 'inhabilitar_folio']);
Route::post('buscaFolioRelacionado',                [FolioRelacionadoController::class, 'buscaFolioRelacionado']);

//Rutas de Personal con Copia de Conocimiento
Route::get('persconoc/nuevo/{id_documento}',                [PersonalConocimientoController::class, 'nuevo_persconoc']);
Route::post('persconoc/guardar',                            [PersonalConocimientoController::class, 'guardar_nuevo_persconoc']);
Route::get('persconoc/editar/{id_documento}/{id_personal}', [PersonalConocimientoController::class, 'editar_persconoc']);
Route::post('persconoc/seguimiento',                        [PersonalConocimientoController::class, 'seguimiento_persconoc']);
Route::get('persconoc/inhabilitar/{id_documento}/{id_personal}', [PersonalConocimientoController::class, 'confirma_inhabilitar_persconoc']);
Route::post('persconoc/inhabilitar',                        [PersonalConocimientoController::class, 'inhabilitar_persconoc']);

//Rutas de Destinatarios Atención
Route::post('destatencion/seguimiento',             [DestinatarioAtencionController::class, 'seguimiento']);

//Rutas de Destinatarios Conocimiento
Route::post('destconoc/seguimiento',                [DestinatarioConocimientoController::class, 'seguimiento']);

//Rutas de Puestos
Route::get('puestos/index',                         [PuestosController::class, 'index'])->name('puestos.index');
Route::get('puestos/nuevo',                         [PuestosController::class, 'nuevo_puesto'])->name('puestos.nuevo');
Route::post('puestos/guardar',                      [PuestosController::class, 'guardar_puesto']);
Route::get('puestos/editar/{id_puesto}',            [PuestosController::class, 'editar_puesto'])->name('puestos.editar');
Route::post('puestos/actualizar',                   [PuestosController::class, 'actualizar_puesto']);
Route::get('puestos/inhabilitar/{id_puesto}',       [PuestosController::class, 'confirmainhabilitar_puesto']);
Route::post('buscaPuestos',                         [PuestosController::class, 'buscaPuestos']);

//Rutas de Adscripciones
Route::get('adscripciones/index',                   [AdscripcionesController::class, 'index'])->name('adscripciones.index');
Route::get('adscripciones/nueva',                   [AdscripcionesController::class, 'nueva_adscripcion'])->name('adscripciones.nueva');
Route::post('adscripciones/guardar',                [AdscripcionesController::class, 'guardar_adscripcion']);
Route::get('adscripciones/editar/{id_adsc}',        [AdscripcionesController::class, 'editar_adscripcion'])->name('adscripciones.editar');
Route::post('adscripciones/actualizar',             [AdscripcionesController::class, 'actualizar_adscripcion']);
Route::get('adscripciones/inhabilitar/{id_adsc}',   [AdscripcionesController::class, 'confirmainhabilitar_adscripcion']);
Route::post('buscaAdscripciones',                   [AdscripcionesController::class, 'buscaAdscripciones']);

//Rutas de Personal
Route::get('personal/index',                        [PersonalController::class, 'index'])->name('personal.index');
Route::get('personal/nuevo',                        [PersonalController::class, 'nuevo_personal'])->name('personal.nuevo');
Route::post('personal/guardar',                     [PersonalController::class, 'guardar_personal']);
//CORRECCIÓN DE DATOS
Route::get('personal/editar/{id_personal}',         [PersonalController::class, 'editar_personal'])->name('personal.editar');
Route::post('personal/actualizar',                  [PersonalController::class, 'actualizar_personal']);
//ACTUALIZAR PUESTO Y ADSCRIPCIÓN, CREANDO UN NUEVO REGISTRO.
Route::get('personal/actualizar/{id_personal}',     [PersonalController::class, 'actualizar_personal_pstoads']);
Route::post('personal/act_psto_adsc',               [PersonalController::class, 'actualizar_psto_adsc']);
//BORRAR / RECUPERAR
Route::get('personal/inhabilitar/{id_personal}',    [PersonalController::class, 'confirmainhabilitar_personal']);
Route::post('buscaPuestoAdscrip',                   [PersonalController::class, 'buscaPuestoAdscrip']);
Route::post('actualizaPuestoAdscrip',               [PersonalController::class, 'actualizaPuestoAdscrip']);
Route::post('buscaOtroNombre',                      [PersonalController::class, 'buscaOtroNombre']);

//Rutas de Usuarios
Route::get('usuarios/index',                        [UsuariosController::class, 'index'])->name('usuarios.index');
Route::get('usuarios/nuevo',                        [UsuariosController::class, 'nuevo_usuario'])->name('usuarios.nuevo');
Route::post('usuarios/guardar',                     [UsuariosController::class, 'guardar_usuario']);
Route::get('usuarios/editar/{id_usuario}',          [UsuariosController::class, 'editar_usuario'])->name('usuarios.editar');
Route::post('usuarios/actualizar',                  [UsuariosController::class, 'actualizar_usuario']);
Route::get('usuarios/inhabilitar/{id_usuario}',     [UsuariosController::class, 'confirmainhabilitar_usuario']);