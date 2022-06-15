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
        DB::table('users')->insert(['name'=>'Luis Ibarra','email'=>'luis.ibarra@tsjcdmx.gob.mx','password' => bcrypt('sistemas'),'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('users')->insert(['name'=>'VICTOR MANUEL ZARAGOZA LARA','email'=>'victor.zaragoza@tsjcdmx.gob.mx','password' => bcrypt('12345678'),'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
