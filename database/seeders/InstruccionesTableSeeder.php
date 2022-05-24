<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InstruccionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'PARA SU ATENCION','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'RESPUESTA INMEDIATA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'ACUERDO CON EL OFICIAL MAYOR','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'SE SIRVA DAR ATENCION AL OFICIO DE MERITO Y PRESENTAR AL OM OFICIO RESPUESTA PARA FIRMA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'SE SOLICITA ATENDER E INFORMAR AL OM LA RESOLUCION DEL OFICIO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'ATENDER SOLICITUD DE INFORMACION Y PREPARAR OFICIO PARA FIRMA DEL OM','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'CONTESTAR DE ACUERDO A LA NORMATIVIDAD','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'CONOCIMIENTO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'EMITIR OPINION Y FIRMAR','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'DAR OPINION AL OFICIAL MAYOR','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'VALIDAR LA INFORMACION','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'PARA LOS EFECTOS CONDUCENTES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'PREPARAR OFICIO RESPUESTA PARA FIRMA DEL OFICIAL MAYOR','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'ATENDER OFICIO Y COMENTAR PREVIAMENTE CON EL OM','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'PREPARAR INFORME','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'REVISAR Y PRESENTAR AL OFICIAL MAYOR PARA VALIDACION Y FIRMA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'EN ESPERA DE INSTRUCCIONES DEL OFICIAL MAYOR','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcinstrucciones')->insert(['cdescripcion_instruccion'=>'ELABORAR NOTA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
