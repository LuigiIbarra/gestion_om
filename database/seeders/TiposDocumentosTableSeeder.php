<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TiposDocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tctipos_documentos')->insert(['cdescripcion_tipo_documento'=>'ACUERDO PL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_documentos')->insert(['cdescripcion_tipo_documento'=>'ACUERDO VAR','iestatus'=>'1','iid_usuario'=>1,'created_at' => Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_documentos')->insert(['cdescripcion_tipo_documento'=>'OFICIO','iestatus'=>'1','iid_usuario'=>1,'created_at' => Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_documentos')->insert(['cdescripcion_tipo_documento'=>'CIRCULAR','iestatus'=>'1','iid_usuario'=>1,'created_at' => Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_documentos')->insert(['cdescripcion_tipo_documento'=>'INFORMES','iestatus'=>'1','iid_usuario'=>1,'created_at' => Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_documentos')->insert(['cdescripcion_tipo_documento'=>'NOTA INFORMATIVA','iestatus'=>'1','iid_usuario'=>1,'created_at' => Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_documentos')->insert(['cdescripcion_tipo_documento'=>'COPIA DE CONOCIMIENTO','iestatus'=>'1','iid_usuario'=>1,'created_at' => Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_documentos')->insert(['cdescripcion_tipo_documento'=>'RECURSOS HUMANOS','iestatus'=>'1','iid_usuario'=>1,'created_at' => Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
