<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use League\Csv\Reader;
use \Datetime;

class DocumentosTableSeeder extends Seeder
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

        $readDirectory = 'database/seeders/OFICIOS_OM_2023.csv';
        $stream = fopen($readDirectory, 'r');

        $reader = Reader::createFromStream($stream, 'r')->setHeaderOffset(0);
        // Indicamos el índice de la fila de nombres de columnas
        foreach ($reader as $r) {
            DB::table('tadocumentos')->insert([
                'iid_documento'             => $r['iid_documento'],
                'cfolio'                    => $r['cfolio'],
                'dfecha_recepcion'          => date("Y-m-d H:i:s", strtotime($r['dfecha_recepcion'])),
                'cnumero_documento'         => $r['cnumero_documento'],
                'dfecha_documento'          => date("Y-m-d H:i:s", strtotime($r['dfecha_documento'])),
                'iid_tipo_documento'        => $r['iid_tipo_documento'],
                'iid_tipo_anexo'            => $r['iid_tipo_anexo'],
                'iid_personal_remitente'    => $r['iid_personal_remitente'],
                'iid_estatus_documento'     => $r['iid_estatus_documento'],
                'iid_prioridad_documento'   => $r['iid_prioridad_documento'],
                'iid_instruccion'           => $r['iid_instruccion'],
              //'dfecha_termino'            => date("Y-m-d H:i:s", strtotime($r['dfecha_termino'])),
                'casunto'                   => utf8_encode(substr($r['casunto'],0,499)),
                'cobservaciones'            => utf8_encode(substr($r['cobservaciones'],0,499)),
                'iestatus'                  => $r['iestatus'],
                'iid_usuario'               => $r['iid_usuario'],
                'created_at'                => Carbon::now()->format('Y-m-d H:i:s')
            ]);
          
        }
    }
}
