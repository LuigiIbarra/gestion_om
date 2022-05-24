<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TiposAnexosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'FACTURA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'DENUNCIA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'FALLO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'FICHA DE DEPÓSITO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'FOTOGRAFÍAS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'FORMATO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'GUIÓN','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'INVITACIÓN','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'RECIBOS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'LISTA DE ASISTENCIA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'MINUTA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'NINGUNO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'NOTA INFORMATIVA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'OBSEQUIO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_anexos')->insert(['cdescripcion_tipo_anexo'=>'OFICIO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
