<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PrioridadesDocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tcprioridades_documentos')->insert(['cdescripcion_prioridad_documento'=>'ALTA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcprioridades_documentos')->insert(['cdescripcion_prioridad_documento'=>'NO REQUIERE RESPUESTA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcprioridades_documentos')->insert(['cdescripcion_prioridad_documento'=>'NORMAL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcprioridades_documentos')->insert(['cdescripcion_prioridad_documento'=>'URGENTE','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
