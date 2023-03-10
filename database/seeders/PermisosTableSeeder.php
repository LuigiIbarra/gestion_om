<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permisos para Puestos
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'alta_puestos','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'edita_puestos','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'borra_puestos','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'consulta_puestos','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);

        //Permisos para Adscripciones
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'alta_adscripciones','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'edita_adscripciones','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'borra_adscripciones','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'consulta_adscripciones','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);

        //Permisos para Personal
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'alta_personal','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'edita_personal','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'borra_personal','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'consulta_personal','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);

        //Permisos para Documentos
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'alta_documentos','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'edita_documentos','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'borra_documentos','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos')->insert(['cnombre_permiso'=>'consulta_documentos','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
