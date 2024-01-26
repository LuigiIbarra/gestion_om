<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EstatusDocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tcestatus_documentos')->insert(['cdescripcion_estatus_documento'=>'PENDIENTE','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcestatus_documentos')->insert(['cdescripcion_estatus_documento'=>'EN PROCESO','iestatus'=>'0','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcestatus_documentos')->insert(['cdescripcion_estatus_documento'=>'CONCLUIDO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcestatus_documentos')->insert(['cdescripcion_estatus_documento'=>'CONOCIMIENTO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
