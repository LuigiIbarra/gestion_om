<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermisosRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//Permisos del rol 1 Sistemas
        //Puestos
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'1','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'2','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'3','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'4','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Adscripciones
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'5','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'6','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'7','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'8','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Personal
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'9','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'10','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'11','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'12','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Documentos
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'13','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'14','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'15','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'1','iid_permiso'=>'16','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);

//Permisos del rol 2 Administrador
        //Puestos
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'1','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'2','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'3','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'4','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Adscripciones
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'5','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'6','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'7','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'8','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Personal
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'9','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'10','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'11','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'12','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Documentos
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'13','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'14','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'15','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'2','iid_permiso'=>'16','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);

//Permisos del rol 3 Captura
        //Puestos
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'1','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'2','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'3','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'4','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Adscripciones
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'5','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'6','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'7','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'8','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Personal
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'9','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'10','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'11','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'12','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Documentos
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'13','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'14','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'15','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'3','iid_permiso'=>'16','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);

//Permisos del rol 4 Seguimiento
        //Puestos
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'1','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'2','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'3','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'4','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Adscripciones
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'5','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'6','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'7','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'8','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Personal
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'9','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'10','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'11','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'12','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Documentos
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'13','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'14','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'15','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'4','iid_permiso'=>'16','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);

//Permisos del rol 5 Consulta
        //Puestos
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'1','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'2','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'3','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'4','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Adscripciones
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'5','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'6','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'7','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'8','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Personal
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'9','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'10','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'11','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'12','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        //Documentos
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'13','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'14','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'15','ipermiso'=>'0','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpermisos_roles')->insert(['iid_rol'=>'5','iid_permiso'=>'16','ipermiso'=>'1','iestatus'=>'1','iid_usuario'=>'1','created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
