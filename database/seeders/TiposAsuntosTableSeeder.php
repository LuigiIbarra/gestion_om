<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TiposAsuntosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tctipos_asuntos')->insert(['cdescripcion_tipo_asunto'=>'PROPUESTAS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_asuntos')->insert(['cdescripcion_tipo_asunto'=>'PRORROGAS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_asuntos')->insert(['cdescripcion_tipo_asunto'=>'RENUNCIAS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_asuntos')->insert(['cdescripcion_tipo_asunto'=>'CAMBIO DE ADSCRIPCIÓN','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_asuntos')->insert(['cdescripcion_tipo_asunto'=>'SOLICITUD DE LICENCIA PREJUBILATORIA CON GOCE DE SUELDO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_asuntos')->insert(['cdescripcion_tipo_asunto'=>'SOLICITUD DE LICENCIA PREJUBILATORIA SIN GOCE DE SUELDO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_asuntos')->insert(['cdescripcion_tipo_asunto'=>'SOLICITUD DE PAGO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_asuntos')->insert(['cdescripcion_tipo_asunto'=>'JUSTIFICANTES DE DESCUENTO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_asuntos')->insert(['cdescripcion_tipo_asunto'=>'PERIODOS VACACIONALES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctipos_asuntos')->insert(['cdescripcion_tipo_asunto'=>'BAJAS DE SEGURO CONSTANCIAS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
