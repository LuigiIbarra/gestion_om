<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(['name'=>'Luis Ibarra','email'=>'luis.ibarra@tsjcdmx.gob.mx','password'=>bcrypt('sistemas'),'iid_rol'=>1,'iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('users')->insert(['name'=>'VÍCTOR MANUEL ZARAGOZA LARA','email'=>'victor.zaragoza@tsjcdmx.gob.mx','password' => bcrypt('12345678'),'iid_rol'=>2,'iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('users')->insert(['name'=>'KARINA HERNÁNDEZ HERNÁNDEZ','email'=>'karina.hernandez@tsjcdmx.gob.mx','password' => bcrypt('12345678'),'iid_rol'=>5,'iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('users')->insert(['name'=>'Carlos Edwing Bocanegra Rangel','email'=>'carlos.bocanegra@tsjcdmx.gob.mx','password' => bcrypt('12345678'),'iid_rol'=>2,'iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('users')->insert(['name'=>'Lilia Julia Gutiérrez Sandoval','email'=>'gutierrezjulia1506@gmail.com','password' => bcrypt('12345678'),'iid_rol'=>2,'iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('users')->insert(['name'=>'Efraín López Román','email'=>'efrain.lopez@tsjcdmx.gob.mx','password' => bcrypt('12345678'),'iid_rol'=>2,'iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('users')->insert(['name'=>'José Cenen Camacho Martínez','email'=>'jose.camacho@tsjcdmx.gob.mx','password' => bcrypt('12345678'),'iid_rol'=>2,'iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('users')->insert(['name'=>'Anel Nohemí Villegas Ibañez','email'=>'anel.villegas@tsjcdmx.gob.mx','password' => bcrypt('12345678'),'iid_rol'=>2,'iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('users')->insert(['name'=>'Juan Martín Carrera Sánchez','email'=>'juan.carrera@tsjcdmx.gob.mx','password' => bcrypt('12345678'),'iid_rol'=>2,'iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('users')->insert(['name'=>'Jessica Ruíz Cruz','email'=>'jessica.ruiz@tsjcdmx.gob.mx','password' => bcrypt('12345678'),'iid_rol'=>2,'iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('users')->insert(['name'=>'Guillermo Nequiz Contreras','email'=>'guillermo.nequiz@tsjcdmx.gob.mx','password' => bcrypt('12345678'),'iid_rol'=>2,'iestatus'=>1,'iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
