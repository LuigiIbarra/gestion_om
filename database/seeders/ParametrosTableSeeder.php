<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ParametrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('parametros')->insert(['ianio'=>'2022','iultimo_folio'=>'0','iultimo_folio_rh'=>'0','iultimo_folio_cc'=>'0','cleyenda_anual_oficios'=>'"2022, Año de Ricardo Flores Magón, Precursor de la Revolución Mexicana"','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('parametros')->insert(['ianio'=>'2023','iultimo_folio'=>'0','iultimo_folio_rh'=>'0','iultimo_folio_cc'=>'0','cleyenda_anual_oficios'=>'"2023 Año de Francisco Villa, el revolucionario del pueblo"','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
