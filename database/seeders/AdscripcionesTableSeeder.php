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
        /*
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'OFICINA DE LA PRESIDENCIA DEL TRIBUNAL SUPERIOR DE JUSTICIA DE LA CIUDAD DE MEXICO Y AREAS AUXILIARES','csiglas'=>'OPTSJCDMXYAA','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'OFICINA DEL OFICIAL MAYOR DEL TRIBUNAL SUPERIOR DE JUSTICIA DE LA CIUDAD DE MEXICO','csiglas'=>'OOFTSJCDMX','iid_tipo_area'=>'4','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION GENERAL DEL CENTRO DE JUSTICIA ALTERNATIVA','csiglas'=>'DGCJA','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION GENERAL DEL INSTITUTO DE ESTUDIOS JUDICIALES','csiglas'=>'DGIEJ','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION GENERAL DE ANALES DE JURISPRUDENCIA Y BOLETIN JUDICIAL','csiglas'=>'DGAJYBJ','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'OFICINA DE LA PRESIDENCIA DEL TRIBUNAL SUPERIOR DE JUSTICIA DE LA CIUDAD DE MEXICO Y AREAS AUXILIARES - PRIMERA SECRETARIA DE ACUERDOS','csiglas'=>'OPTSJCDMXYAA-PSA','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION GENERAL JURIDICA','csiglas'=>'DGJ','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'OFICINA DE LA PRESIDENCIA DEL TRIBUNAL SUPERIOR DE JUSTICIA DE LA CIUDAD DE MEXICO Y AREAS AUXILIARES - JEFATURA DE LA OFICINA DEL PRESIDENTE','csiglas'=>'OPTSJCDMXYAA-JOP','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION GENERAL DE GESTION JUDICIAL','csiglas'=>'DEGJ','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION EJECUTIVA DE LA USMC','csiglas'=>'DEUSMC','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION EJECUTIVA DE ORIENTACION CIUDADANA Y DERECHOS HUMANOS','csiglas'=>'DEOCYDH','iid_tipo_area'=>'8','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION EJECUTIVA DE PLANEACION','csiglas'=>'DEP','iid_tipo_area'=>'4','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'COORDINACION DE INTERVENCION ESPECIALIZADA PARA APOYO JUDICIAL','csiglas'=>'CIEPAJ','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION EJECUTIVA DE GESTION TECNOLOGICA','csiglas'=>'DEGT','iid_tipo_area'=>'4','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION EJECUTIVA DE RECURSOS HUMANOS','csiglas'=>'DERH','iid_tipo_area'=>'4','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION EJECUTIVA DE OBRAS, MANTENIMIENTO Y SERVICIOS','csiglas'=>'DEOMS','iid_tipo_area'=>'4','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION EJECUTIVA DE RECURSOS MATERIALES','csiglas'=>'DERM','iid_tipo_area'=>'4','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION EJECUTIVA DE RECURSOS FINANCIEROS','csiglas'=>'DERF','iid_tipo_area'=>'4','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'INSTITUTO DE CIENCIAS FORENSES ','csiglas'=>'INCIFO','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION DE TURNO DE CONSIGNACIONES PENALES Y DE JUSTICIA PARA ADOLESCENTES','csiglas'=>'DTCPYJPA','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'OFICINA DE LA PRESIDENCIA DEL TRIBUNAL SUPERIOR DE JUSTICIA DE LA CIUDAD DE MEXICO Y AREAS AUXILIARES - SEGUNDA SECRETARIA DE ACUERDOS','csiglas'=>'OPTSJCDMXYAA-SSA','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'OFICINA DE LA PRESIDENCIA DEL TRIBUNAL SUPERIOR DE JUSTICIA DE LA CIUDAD DE MEXICO Y AREAS AUXILIARES - COORDINACION DE COMUNICACION SOCIAL','csiglas'=>'OPTSJCDMXYAA-CCS','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION DE OFICIALIA DE PARTES COMUN CIVIL, CUANTIA MENOR, ORALIDAD, FAMILIAR Y SECCION SALAS','csiglas'=>'DOPCCCMOFSS','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION EJECUTIVA DE LA UNIDAD DE SUPERVISION DE MEDIDAS CAUTELARES Y SUSPENSION CONDICIONAL DEL PROCESO','csiglas'=>'DEUSMCYSCP','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION DE SEGURIDAD','csiglas'=>'DS','iid_tipo_area'=>'8','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'DIRECCION DE CONSIGNACIONES CIVILES','csiglas'=>'DCC','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE TRANSPARENCIA DEL TRIBUNAL SUPERIOR DE JUSTICIA DE LA CIUDAD DE MEXICO','csiglas'=>'UTTSJCDMX','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL EN MATERIA DE JUSTICIA PARA ADOLESCENTES','csiglas'=>'UGJMJPA','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL EN MATERIA DE EJECUCION DE MEDIDAS SANCIONADORAS','csiglas'=>'UGJMEMS','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'OFICINA DE LA PRESIDENCIA DEL TRIBUNAL SUPERIOR DE JUSTICIA DE LA CIUDAD DE MEXICO Y AREAS AUXILIARES - DIRECCION DE ESTADISTICA','csiglas'=>'OPTSJCDMXYAA-DE','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL EN EJECUCION DE SANCIONES PENALES RECLUSORIO NORTE','csiglas'=>'UGJESPRN','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL EN EJECUCION DE SANCIONES PENALES RECLUSORIO ORIENTE','csiglas'=>'UGJESPRO','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL EN EJECUCION DE SANCIONES PENALES SULLIVAN','csiglas'=>'UGJESPS','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL 1','csiglas'=>'UGJ1','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL 2','csiglas'=>'UGJ2','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL 3','csiglas'=>'UGJ3','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL 4','csiglas'=>'UGJ4','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL 5','csiglas'=>'UGJ5','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL 6','csiglas'=>'UGJ6','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL 7','csiglas'=>'UGJ7','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL 8','csiglas'=>'UGJ8','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL 9','csiglas'=>'UGJ9','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL 10','csiglas'=>'UGJ10','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL 11','csiglas'=>'UGJ11','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION JUDICIAL 12','csiglas'=>'UGJ12','iid_tipo_area'=>'3','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'UNIDAD DE GESTION ADMINISTRATIVA DE PROCESO ORAL EN MATERIA FAMILIAR','csiglas'=>'UGAPOMF','iid_tipo_area'=>'8','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA CIVIL 1','csiglas'=>'SC01','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA CIVIL 2','csiglas'=>'SC02','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA CIVIL 3','csiglas'=>'SC03','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA CIVIL 4','csiglas'=>'SC04','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA CIVIL 5','csiglas'=>'SC05','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA CIVIL 6','csiglas'=>'SC06','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA CIVIL 7','csiglas'=>'SC07','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA CIVIL 8','csiglas'=>'SC08','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA CIVIL 9','csiglas'=>'SC09','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA CIVIL 10','csiglas'=>'SC10','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA FAMILIAR 1','csiglas'=>'SF01','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA FAMILIAR 2','csiglas'=>'SF02','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA FAMILIAR 3','csiglas'=>'SF03','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA FAMILIAR 4','csiglas'=>'SF04','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA FAMILIAR 5','csiglas'=>'SF05','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA PENAL 1','csiglas'=>'SP01','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA PENAL 2','csiglas'=>'SP02','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA PENAL 3','csiglas'=>'SP03','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA PENAL 4','csiglas'=>'SP04','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA PENAL 5','csiglas'=>'SP05','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA PENAL 6','csiglas'=>'SP06','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA PENAL 7','csiglas'=>'SP07','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA PENAL 8','csiglas'=>'SP08','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA PENAL 9','csiglas'=>'SP09','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA DE JUSTICIA PARA ADOLESCENTES 1','csiglas'=>'SJPA01','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
         DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'SALA DE JUSTICIA PARA ADOLESCENTES 2','csiglas'=>'SJPA02','iid_tipo_area'=>'2','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 1','csiglas'=>'JC01','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 2','csiglas'=>'JC02','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 4','csiglas'=>'JC04','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 6','csiglas'=>'JC06','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 7','csiglas'=>'JC07','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 8','csiglas'=>'JC08','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 9','csiglas'=>'JC09','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 10','csiglas'=>'JC10','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 11','csiglas'=>'JC11','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 12','csiglas'=>'JC12','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 13','csiglas'=>'JC13','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 14','csiglas'=>'JC14','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 15','csiglas'=>'JC15','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 16','csiglas'=>'JC16','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 17','csiglas'=>'JC17','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 18','csiglas'=>'JC18','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 19','csiglas'=>'JC19','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 20','csiglas'=>'JC20','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 21','csiglas'=>'JC21','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 22','csiglas'=>'JC22','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 23','csiglas'=>'JC23','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 24','csiglas'=>'JC24','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 25','csiglas'=>'JC25','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 27','csiglas'=>'JC27','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 28','csiglas'=>'JC28','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 29','csiglas'=>'JC29','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 30','csiglas'=>'JC30','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 31','csiglas'=>'JC31','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 32','csiglas'=>'JC32','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 33','csiglas'=>'JC33','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 34','csiglas'=>'JC34','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 35','csiglas'=>'JC35','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 36','csiglas'=>'JC36','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 38','csiglas'=>'JC38','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 39','csiglas'=>'JC39','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 40','csiglas'=>'JC40','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 41','csiglas'=>'JC41','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 42','csiglas'=>'JC42','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 44','csiglas'=>'JC44','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 45','csiglas'=>'JC45','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 46','csiglas'=>'JC46','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 47','csiglas'=>'JC47','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 49','csiglas'=>'JC49','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 51','csiglas'=>'JC51','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 52','csiglas'=>'JC52','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 54','csiglas'=>'JC54','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 55','csiglas'=>'JC55','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 57','csiglas'=>'JC57','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 58','csiglas'=>'JC58','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 60','csiglas'=>'JC60','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 61','csiglas'=>'JC61','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 62','csiglas'=>'JC62','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 63','csiglas'=>'JC63','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 64','csiglas'=>'JC64','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 65','csiglas'=>'JC65','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 67','csiglas'=>'JC67','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 68','csiglas'=>'JC68','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 69','csiglas'=>'JC69','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 70','csiglas'=>'JC70','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 71','csiglas'=>'JC71','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 72','csiglas'=>'JC72','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        DB::table('tcadscripciones')->insert(['cdescripcion_adscripcion'=>'JUZGADO DE LO CIVIL 73','csiglas'=>'JC73','iid_tipo_area'=>'1','iestatus'=>'1','iid_usuario'=>1,'created_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        */
        if (!ini_get("auto_detect_line_endings")) 
        {
            ini_set("auto_detect_line_endings", '1');     
        }   

        $readDirectory = 'database/seeders/cat_areas.csv';
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
