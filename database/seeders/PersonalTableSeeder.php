<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PersonalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'RAFAEL','cpaterno_personal'=>'GUERRA','cmaterno_personal'=>'ALVAREZ','iid_puesto'=>1,'iid_adscripcion'=>1,'ccorreo_electronico'=>'presidencia.tsjcdmx@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'SERGIO','cpaterno_personal'=>'FONTES','cmaterno_personal'=>'GRANADO','iid_puesto'=>2,'iid_adscripcion'=>2,'ccorreo_electronico'=>'sergio.fontes@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'MARIA CLAUDIA','cpaterno_personal'=>'CAMPUZANO','cmaterno_personal'=>'CABALLERO','iid_puesto'=>3,'iid_adscripcion'=>3,'ccorreo_electronico'=>'maria.campuzano@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'MARIA ELENA','cpaterno_personal'=>'RAMIREZ','cmaterno_personal'=>'SANCHEZ','iid_puesto'=>5,'iid_adscripcion'=>4,'ccorreo_electronico'=>'maria.ramirez@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'RACIEL','cpaterno_personal'=>'GARRIDO','cmaterno_personal'=>'MALDONADO','iid_puesto'=>8,'iid_adscripcion'=>5,'ccorreo_electronico'=>'raciel.garrido@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'MARIA DEL SOCORRO','cpaterno_personal'=>'RAZO','cmaterno_personal'=>'ZAMORA','iid_puesto'=>9,'iid_adscripcion'=>6,'ccorreo_electronico'=>'maria.razo@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'ALFONSO','cpaterno_personal'=>'SIERRA','cmaterno_personal'=>'LAM','iid_puesto'=>12,'iid_adscripcion'=>7,'ccorreo_electronico'=>'alfonso.sierra@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'HECTOR SAMUEL','cpaterno_personal'=>'CASILLAS','cmaterno_personal'=>'MACEDO','iid_puesto'=>14,'iid_adscripcion'=>8,'ccorreo_electronico'=>'hector.casillas@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'ARMANDO','cpaterno_personal'=>'SANCHEZ','cmaterno_personal'=>'PALACIOS','iid_puesto'=>16,'iid_adscripcion'=>9,'ccorreo_electronico'=>'armando.sanchez@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'MOISES','cpaterno_personal'=>'PRATS','cmaterno_personal'=>'VILLERS','iid_puesto'=>54,'iid_adscripcion'=>24,'ccorreo_electronico'=>'moises.prats@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'SOCORRO','cpaterno_personal'=>'MORA','cmaterno_personal'=>'CASTRO','iid_puesto'=>19,'iid_adscripcion'=>1,'ccorreo_electronico'=>'socorro.mora@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'YOLANDA','cpaterno_personal'=>'RANGEL','cmaterno_personal'=>'BALMACEDA','iid_puesto'=>21,'iid_adscripcion'=>11,'ccorreo_electronico'=>'yolanda.rangel@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'DANIEL','cpaterno_personal'=>'GONZALEZ','cmaterno_personal'=>'RAMIREZ','iid_puesto'=>24,'iid_adscripcion'=>12,'ccorreo_electronico'=>'daniel.gonzalez@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'KAREN NALLELY','cpaterno_personal'=>'MIRANDA','cmaterno_personal'=>'REYES','iid_puesto'=>25,'iid_adscripcion'=>1,'ccorreo_electronico'=>'karen.miranda@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'MARIANA','cpaterno_personal'=>'ORTIZ','cmaterno_personal'=>'CASTAÑARES','iid_puesto'=>27,'iid_adscripcion'=>13,'ccorreo_electronico'=>'mariana.ortiz@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'FEDERICO','cpaterno_personal'=>'VARGAS','cmaterno_personal'=>'ORTIZ','iid_puesto'=>30,'iid_adscripcion'=>14,'ccorreo_electronico'=>'federico.vargas@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'RIGOBERTO','cpaterno_personal'=>'CONTRERAS','cmaterno_personal'=>'GARCIA','iid_puesto'=>32,'iid_adscripcion'=>15,'ccorreo_electronico'=>'rigoberto.contreras@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'TEDDY WAYNE','cpaterno_personal'=>'BROCK','cmaterno_personal'=>'CORTES','iid_puesto'=>34,'iid_adscripcion'=>16,'ccorreo_electronico'=>'teddy.brock@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'TITO ARISTIDES','cpaterno_personal'=>'CRUZ','cmaterno_personal'=>'ALVARADO','iid_puesto'=>36,'iid_adscripcion'=>17,'ccorreo_electronico'=>'tito.cruz@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpersonal')->insert(['cnombre_personal'=>'LAURA ELIZABETH','cpaterno_personal'=>'GONZALEZ','cmaterno_personal'=>'STANFORD','iid_puesto'=>37,'iid_adscripcion'=>18,'ccorreo_electronico'=>'laura.gonzalez@tsjcdmx.gob.mx','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
