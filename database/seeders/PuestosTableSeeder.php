<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PuestosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'PRESIDENTE DEL TRIBUNAL SUPERIOR DE JUSTICIA DE LA CIUDAD DE MEXICO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'OFICIAL MAYOR','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA GENERAL DEL CENTRO DE JUSTICIA ALTERNATIVA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR GENERAL DEL CENTRO DE JUSTICIA ALTERNATIVA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA GENERAL DEL INSTITUTO DE ESTUDIOS JUDICIALES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR GENERAL DEL INSTITUTO DE ESTUDIOS JUDICIALES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA GENERAL DE ANALES DE JURISPRUDENCIA Y BOLETIN JUDICIAL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR GENERAL DE ANALES DE JURISPRUDENCIA Y BOLETIN JUDICIAL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'PRIMERA SECRETARIA DE ACUERDOS DE LA PRESIDENCIA Y DEL PLENO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'PRIMER SECRETARIO DE ACUERDOS DE LA PRESIDENCIA Y DEL PLENO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA GENERAL JURIDICO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR GENERAL JURIDICO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'JEFA DE LA OFICINA DEL PRESIDENTE DEL TRIBUNAL SUPERIOR DE JUSTICIA DE LA CIUDAD DE MEXICO - POR COMISION','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'JEFE DE LA OFICINA DEL PRESIDENTE DEL TRIBUNAL SUPERIOR DE JUSTICIA DE LA CIUDAD DE MEXICO - POR COMISION','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA GENERAL DE GESTION JUDICIAL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR GENERAL DE GESTION JUDICIAL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA EJECUTIVA DE LA USMC','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR EJECUTIVO DE LA USMC','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'ASESORA "B"','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'ASESOR "B"','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA EJECUTIVA DE ORIENTACION CIUDADANA Y DERECHOS HUMANOS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR EJECUTIVO DE ORIENTACION CIUDADANA Y DERECHOS HUMANOS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA EJECUTIVA DE PLANEACION','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR EJECUTIVO DE PLANEACION','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'SECRETARIA PARTICULAR DEL PRESIDENTE','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'SECRETARIO PARTICULAR DEL PRESIDENTE','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'COORDINADORA DE INTERVENCION ESPECIALIZADA PARA APOYO JUDICIAL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'COORDINADOR DE INTERVENCION ESPECIALIZADO PARA APOYO JUDICIAL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA EJECUTIVA DE GESTION TECNOLOGICA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR EJECUTIVO DE GESTION TECNOLOGICA','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA EJECUTIVA DE RECURSOS HUMANOS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR EJECUTIVO DE RECURSOS HUMANOS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA EJECUTIVA DE OBRAS, MANTENIMIENTO Y SERVICIOS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR EJECUTIVO DE OBRAS, MANTENIMIENTO Y SERVICIOS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA EJECUTIVA DE RECURSOS MATERIALES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR EJECUTIVO DE RECURSOS MATERIALES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA EJECUTIVA DE RECURSOS FINANCIEROS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR EJECUTIVO DE RECURSOS FINANCIEROS','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA DEL INSTITUTO DE CIENCIAS FORENSES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR DEL INSTITUTO DE CIENCIAS FORENSES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA DE TURNO DE CONSIGNACIONES PENALES Y DE JUSTICIA PARA ADOLESCENTES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR DE TURNO DE CONSIGNACIONES PENALES Y DE JUSTICIA PARA ADOLESCENTES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'SEGUNDA SECRETARIA DE ACUERDOS DE LA PRESIDENCIA Y DEL PLENO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'SEGUNDO SECRETARIO DE ACUERDOS DE LA PRESIDENCIA Y DEL PLENO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'COORDINADORA DE COMUNICACION SOCIAL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'COORDINADOR DE COMUNICACION SOCIAL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA DE LA UNIDAD DE GESTION JUDICIAL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR DE LA UNIDAD DE GESTION JUDICIAL','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA DEL ARCHIVO JUDICIAL DEL DISTRITO FEDERAL Y DEL REGISTRO PUBLICO DE AVISOS JUDICIALES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR DEL ARCHIVO JUDICIAL DEL DISTRITO FEDERAL Y DEL REGISTRO PUBLICO DE AVISOS JUDICIALES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA DE ANALES DE JURISPRUDENCIA Y PUBLICACIONES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR DE ANALES DE JURISPRUDENCIA Y PUBLICACIONES','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTORA DE LA UNIDAD DE SUPERVISION DE MEDIDAS CAUTELARES Y SUSPENSION CONDICIONAL DEL PROCESO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcpuestos')->insert(['cdescripcion_puesto'=>'DIRECTOR DE LA UNIDAD DE SUPERVISION DE MEDIDAS CAUTELARES Y SUSPENSION CONDICIONAL DEL PROCESO','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
    }
}
