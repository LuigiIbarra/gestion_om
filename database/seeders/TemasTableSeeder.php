<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'ACUERDO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'AUDITORÍA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'AUTORIZACIÓN','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'COMISIÓN','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'CONTRATO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'DEMANDA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'DERECHOS HUMANOS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'DESCUENTO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'DESISTIMIENTO DE RENUNCIA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'EXAMEN','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'FIANZA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'GESTIÓN','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'INASISTENCIA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'INFORMACIÓN PÚBLICA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'INFORME','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'JUICIO LABORAL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'LIBERACIÓN DE FIANZA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'LICENCIA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'MANTENIMIENTO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'MULTA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'OBRA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'PERIODO VACACIONAL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'PERMUTA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'PROMOCIÓN','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'PROPUESTA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'PRÓRROGA DE NOMBRAMIENTO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'PRÓRROGA INDEFINIDA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tctemas')->insert(['cdescripcion_tema'=>'PUESTA A DISPOSICIÓN','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
