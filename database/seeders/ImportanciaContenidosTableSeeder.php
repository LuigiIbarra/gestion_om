<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImportanciaContenidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tcimportancia_contenidos')->insert(['cdescripcion_importancia_conten'=>'ORDINARIO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcimportancia_contenidos')->insert(['cdescripcion_importancia_conten'=>'IMPORTANTE','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcimportancia_contenidos')->insert(['cdescripcion_importancia_conten'=>'RELEVANTE','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
