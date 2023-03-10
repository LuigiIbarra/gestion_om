<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class PermisosServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    //Crea directivas blade personalizadas para restringir opciones en html conforme a permisos.
    //Permisos para Puestos
        Blade::if('altaPuesto', function(){
            return optional(auth()->user())->verificaPermiso('alta_puestos');
        });
        Blade::if('editaPuesto', function(){
            return optional(auth()->user())->verificaPermiso('edita_puestos');
        });
        Blade::if('borraPuesto', function(){
            return optional(auth()->user())->verificaPermiso('borra_puestos');
        });
        Blade::if('consultaPuesto', function(){
            return optional(auth()->user())->verificaPermiso('consulta_puestos');
        });
    //Permisos para Adscripciones
        Blade::if('altaAdscripcion', function(){
            return optional(auth()->user())->verificaPermiso('alta_adscripciones');
        });
        Blade::if('editaAdscripcion', function(){
            return optional(auth()->user())->verificaPermiso('edita_adscripciones');
        });
        Blade::if('borraAdscripcion', function(){
            return optional(auth()->user())->verificaPermiso('borra_adscripciones');
        });
        Blade::if('consultaAdscripcion', function(){
            return optional(auth()->user())->verificaPermiso('consulta_adscripciones');
        });
    //Permisos para Personal
        Blade::if('altaPersonal', function(){
            return optional(auth()->user())->verificaPermiso('alta_personal');
        });
        Blade::if('editaPersonal', function(){
            return optional(auth()->user())->verificaPermiso('edita_personal');
        });
        Blade::if('borraPersonal', function(){
            return optional(auth()->user())->verificaPermiso('borra_personal');
        });
        Blade::if('consultaPersonal', function(){
            return optional(auth()->user())->verificaPermiso('consulta_personal');
        });
    //Permisos para Documentos
        Blade::if('altaDocumento', function(){
            return optional(auth()->user())->verificaPermiso('alta_documentos');
        });
        Blade::if('editaDocumento', function(){
            return optional(auth()->user())->verificaPermiso('edita_documentos');
        });
        Blade::if('borraDocumento', function(){
            return optional(auth()->user())->verificaPermiso('borra_documentos');
        });
        Blade::if('consultaDocumento', function(){
            return optional(auth()->user())->verificaPermiso('consulta_documentos');
        });
    }
}
