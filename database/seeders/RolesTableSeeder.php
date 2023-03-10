<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tcroles')->insert(['cnombre_rol'=>'Sistemas','cdescripcion_rol'=>'Cuenta de Sistemas','iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcroles')->insert(['cnombre_rol'=>'Administrador','cdescripcion_rol'=>'Cuenta de Administrador Oficialía Mayor','iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcroles')->insert(['cnombre_rol'=>'Captura','cdescripcion_rol'=>'Captura de atención a correspondencia','iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcroles')->insert(['cnombre_rol'=>'Seguimiento','cdescripcion_rol'=>'Seguimiento de atención a correspondencia','iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcroles')->insert(['cnombre_rol'=>'Consulta','cdescripcion_rol'=>'Consulta de atención a correspondencia','iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);

    }
}
