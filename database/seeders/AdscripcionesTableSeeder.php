<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use League\Csv\Reader;

class AdscripcionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!ini_get("auto_detect_line_endings")) 
        {
            ini_set("auto_detect_line_endings", '1');     
        }   

      //$readDirectory = 'database/seeders/cat_areas.csv';
        $readDirectory = 'database/seeders/AreasM4.csv';
        $stream = fopen($readDirectory, 'r');

        $reader = Reader::createFromStream($stream, 'r')->setHeaderOffset(0);
        // Indicamos el índice de la fila de nombres de columnas
        foreach ($reader as $r) {
            DB::table('tcadscripciones')->insert([
                'iid_adscripcion'           => $r['iid_adscripcion'],
                'cdescripcion_adscripcion'  => utf8_encode($r['cdescripcion_adscripcion']),
                'iid_tipo_area'           => $r['iid_tipo_area'],
                'iestatus'                  => $r['iestatus'],
                'iid_usuario'               => $r['iid_usuario'],
                'created_at'                => Carbon::now()->format('Y-m-d H:i:s')
            ]);
          
        }
    }

}
