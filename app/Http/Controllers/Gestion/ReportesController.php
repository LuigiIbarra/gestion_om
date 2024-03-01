<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Catalogos\PersonalController;
use App\Http\Controllers\Catalogos\PuestosController;
use App\Http\Controllers\Catalogos\AdscripcionesController;
use App\Http\Controllers\Gestion\PersonalConocimientoController;
use App\Http\Controllers\Gestion\DestinatarioAtencionController;
use App\Http\Controllers\Gestion\DestinatarioConocimientoController;
use App\Http\Controllers\Gestion\FolioRelacionadoController;

use App\Models\Gestion\Documento;
use App\Models\Catalogos\Puesto;
use App\Models\Catalogos\Adscripcion;
use App\Models\Catalogos\TipoArea;
use App\Models\Catalogos\Personal;
use App\Models\Catalogos\TipoDocumento;
use App\Models\Catalogos\TipoAnexo;
use App\Models\Catalogos\EstatusDocumento;
use App\Models\Catalogos\PrioridadDocumento;
use App\Models\Catalogos\Semaforo;
use App\Models\Catalogos\ImportanciaContenido;
use App\Models\Catalogos\Tema;
use App\Models\Catalogos\TipoAsunto;
use App\Models\Catalogos\Instruccion;
use App\Models\Catalogos\Parametros;
use App\Models\Gestion\DestinatarioAtencion;
use App\Models\Gestion\DestinatarioConocimiento;
use App\Models\Gestion\PersonalConocimiento;
use App\Models\Gestion\FolioRelacionado;
use App\Models\Gestion\Bitacora;

use Mpdf\Mpdf;

use \stdClass;
use \Datetime;
use \DateInterval;

class ReportesController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

    public function param_estadistico()
    {
        return view('documentos.creaPDF.param_estadistico');
    }

    public function reporte_estadistico(Request $request)
    {
        setlocale(LC_TIME, "spanish");  //FECHA EN ESPANIOL
        $fecha              = date('Y-m-d');
        $data['fecha']      = $fecha;
        $anio               = date('Y');
        $data['anio']       = $anio;
        $parametros         = Parametros::where('ianio','=',$anio)->first();
        $data['parametros'] = $parametros;
        $data['anio_consulta']  = $request->anio_consulta;
        $nombreArchivo = 'estadistico_'.$fecha.'.pdf';

        $dtfecha_inicial        = DateTime::createFromFormat('d-m-Y', '01-01-'.$request->anio_consulta);
        $fecha_inicial          = $dtfecha_inicial->format("d-m-Y");
        $fi                     = $dtfecha_inicial->format("Y-m-d");
        $data['fecha_inicial']  = $fecha_inicial;
        $dtfecha_final          = DateTime::createFromFormat('d-m-Y', '31-12-'.$request->anio_consulta);
        $fecha_final            = $dtfecha_final->format("d-m-Y");
        $ff                     = $dtfecha_final->format("Y-m-d");
        $data['fecha_final']    = $fecha_final;

//FECHAS POR MES
        $dtenei                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-01-01');
        $dtenef                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-01-31');
        $enei = $dtenei->format("Y-m-d");
        $enef = $dtenef->format("Y-m-d");
        $dtfebi                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-02-01');
        $dtfebf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-02-28');
        $febi = $dtfebi->format("Y-m-d");
        $febf = $dtfebf->format("Y-m-d");
        $dtmzoi                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-03-01');
        $dtmzof                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-03-31');
        $mzoi = $dtmzoi->format("Y-m-d");
        $mzof = $dtmzof->format("Y-m-d");
        $dtabri                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-04-01');
        $dtabrf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-04-30');
        $abri = $dtabri->format("Y-m-d");
        $abrf = $dtabrf->format("Y-m-d");
        $dtmayi                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-05-01');
        $dtmayf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-05-31');
        $mayi = $dtmayi->format("Y-m-d");
        $mayf = $dtmayf->format("Y-m-d");
        $dtjuni                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-06-01');
        $dtjunf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-06-30');
        $juni = $dtjuni->format("Y-m-d");
        $junf = $dtjunf->format("Y-m-d");
        $dtjuli                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-07-01');
        $dtjulf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-07-31');
        $juli = $dtjuli->format("Y-m-d");
        $julf = $dtjulf->format("Y-m-d");
        $dtagoi                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-08-01');
        $dtagof                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-08-31');
        $agoi = $dtagoi->format("Y-m-d");
        $agof = $dtagof->format("Y-m-d");
        $dtsepi                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-09-01');
        $dtsepf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-09-30');
        $sepi = $dtsepi->format("Y-m-d");
        $sepf = $dtsepf->format("Y-m-d");
        $dtocti                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-10-01');
        $dtoctf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-10-31');
        $octi = $dtocti->format("Y-m-d");
        $octf = $dtoctf->format("Y-m-d");
        $dtnovi                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-11-01');
        $dtnovf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-11-30');
        $novi = $dtnovi->format("Y-m-d");
        $novf = $dtnovf->format("Y-m-d");
        $dtdici                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-12-01');
        $dtdicf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-12-31');
        $dici = $dtdici->format("Y-m-d");
        $dicf = $dtdicf->format("Y-m-d");

//CONTADORES DERH 231
        $area   = '231';
        $status = '1'; //1=PENDIENTES, 3=CONCLUIDOS
        $data['derh_pend_ene']  = ReportesController::cuenta_documentos($area,$enei,$enef,$status);
        $data['derh_pend_feb']  = ReportesController::cuenta_documentos($area,$febi,$febf,$status);
        $data['derh_pend_mzo']  = ReportesController::cuenta_documentos($area,$mzoi,$mzof,$status);
        $data['derh_pend_abr']  = ReportesController::cuenta_documentos($area,$abri,$abrf,$status);
        $data['derh_pend_may']  = ReportesController::cuenta_documentos($area,$mayi,$mayf,$status);
        $data['derh_pend_jun']  = ReportesController::cuenta_documentos($area,$juni,$junf,$status);
        $data['derh_pend_jul']  = ReportesController::cuenta_documentos($area,$juli,$julf,$status);
        $data['derh_pend_ago']  = ReportesController::cuenta_documentos($area,$agoi,$agof,$status);
        $data['derh_pend_sep']  = ReportesController::cuenta_documentos($area,$sepi,$sepf,$status);
        $data['derh_pend_oct']  = ReportesController::cuenta_documentos($area,$octi,$octf,$status);
        $data['derh_pend_nov']  = ReportesController::cuenta_documentos($area,$novi,$novf,$status);
        $data['derh_pend_dic']  = ReportesController::cuenta_documentos($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['derh_pend']      = ReportesController::cuenta_documentos($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['derh_conc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
//CONTADORES DERF 230
        $area   = '230';
        $data['derf_pend_ene']  = ReportesController::cuenta_documentos($area,$enei,$enef,$status);
        $data['derf_pend_feb']  = ReportesController::cuenta_documentos($area,$febi,$febf,$status);
        $data['derf_pend_mzo']  = ReportesController::cuenta_documentos($area,$mzoi,$mzof,$status);
        $data['derf_pend_abr']  = ReportesController::cuenta_documentos($area,$abri,$abrf,$status);
        $data['derf_pend_may']  = ReportesController::cuenta_documentos($area,$mayi,$mayf,$status);
        $data['derf_pend_jun']  = ReportesController::cuenta_documentos($area,$juni,$junf,$status);
        $data['derf_pend_jul']  = ReportesController::cuenta_documentos($area,$juli,$julf,$status);
        $data['derf_pend_ago']  = ReportesController::cuenta_documentos($area,$agoi,$agof,$status);
        $data['derf_pend_sep']  = ReportesController::cuenta_documentos($area,$sepi,$sepf,$status);
        $data['derf_pend_oct']  = ReportesController::cuenta_documentos($area,$octi,$octf,$status);
        $data['derf_pend_nov']  = ReportesController::cuenta_documentos($area,$novi,$novf,$status);
        $data['derf_pend_dic']  = ReportesController::cuenta_documentos($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['derf_pend']      = ReportesController::cuenta_documentos($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['derf_conc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
//CONTADORES DEOMS 228
        $area   = '228';
        $data['deoms_pend_ene'] = ReportesController::cuenta_documentos($area,$enei,$enef,$status);
        $data['deoms_pend_feb'] = ReportesController::cuenta_documentos($area,$febi,$febf,$status);
        $data['deoms_pend_mzo'] = ReportesController::cuenta_documentos($area,$mzoi,$mzof,$status);
        $data['deoms_pend_abr'] = ReportesController::cuenta_documentos($area,$abri,$abrf,$status);
        $data['deoms_pend_may'] = ReportesController::cuenta_documentos($area,$mayi,$mayf,$status);
        $data['deoms_pend_jun'] = ReportesController::cuenta_documentos($area,$juni,$junf,$status);
        $data['deoms_pend_jul'] = ReportesController::cuenta_documentos($area,$juli,$julf,$status);
        $data['deoms_pend_ago'] = ReportesController::cuenta_documentos($area,$agoi,$agof,$status);
        $data['deoms_pend_sep'] = ReportesController::cuenta_documentos($area,$sepi,$sepf,$status);
        $data['deoms_pend_oct'] = ReportesController::cuenta_documentos($area,$octi,$octf,$status);
        $data['deoms_pend_nov'] = ReportesController::cuenta_documentos($area,$novi,$novf,$status);
        $data['deoms_pend_dic'] = ReportesController::cuenta_documentos($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['deoms_pend']     = ReportesController::cuenta_documentos($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['deoms_conc']     = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
//CONTADORES DEP 229
        $area   = '229';
        $data['dep_pend_ene']   = ReportesController::cuenta_documentos($area,$enei,$enef,$status);
        $data['dep_pend_feb']   = ReportesController::cuenta_documentos($area,$febi,$febf,$status);
        $data['dep_pend_mzo']   = ReportesController::cuenta_documentos($area,$mzoi,$mzof,$status);
        $data['dep_pend_abr']   = ReportesController::cuenta_documentos($area,$abri,$abrf,$status);
        $data['dep_pend_may']   = ReportesController::cuenta_documentos($area,$mayi,$mayf,$status);
        $data['dep_pend_jun']   = ReportesController::cuenta_documentos($area,$juni,$junf,$status);
        $data['dep_pend_jul']   = ReportesController::cuenta_documentos($area,$juli,$julf,$status);
        $data['dep_pend_ago']   = ReportesController::cuenta_documentos($area,$agoi,$agof,$status);
        $data['dep_pend_sep']   = ReportesController::cuenta_documentos($area,$sepi,$sepf,$status);
        $data['dep_pend_oct']   = ReportesController::cuenta_documentos($area,$octi,$octf,$status);
        $data['dep_pend_nov']   = ReportesController::cuenta_documentos($area,$novi,$novf,$status);
        $data['dep_pend_dic']   = ReportesController::cuenta_documentos($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['dep_pend']       = ReportesController::cuenta_documentos($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['dep_conc']       = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
//CONTADORES DERM 232
        $area = '232';
        $data['derm_pend_ene']   = ReportesController::cuenta_documentos($area,$enei,$enef,$status);
        $data['derm_pend_feb']   = ReportesController::cuenta_documentos($area,$febi,$febf,$status);
        $data['derm_pend_mzo']   = ReportesController::cuenta_documentos($area,$mzoi,$mzof,$status);
        $data['derm_pend_abr']   = ReportesController::cuenta_documentos($area,$abri,$abrf,$status);
        $data['derm_pend_may']   = ReportesController::cuenta_documentos($area,$mayi,$mayf,$status);
        $data['derm_pend_jun']   = ReportesController::cuenta_documentos($area,$juni,$junf,$status);
        $data['derm_pend_jul']   = ReportesController::cuenta_documentos($area,$juli,$julf,$status);
        $data['derm_pend_ago']   = ReportesController::cuenta_documentos($area,$agoi,$agof,$status);
        $data['derm_pend_sep']   = ReportesController::cuenta_documentos($area,$sepi,$sepf,$status);
        $data['derm_pend_oct']   = ReportesController::cuenta_documentos($area,$octi,$octf,$status);
        $data['derm_pend_nov']   = ReportesController::cuenta_documentos($area,$novi,$novf,$status);
        $data['derm_pend_dic']   = ReportesController::cuenta_documentos($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['derm_pend']       = ReportesController::cuenta_documentos($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['derm_conc']       = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
//CONTADORES DEGT 227
        $area = '227';
        $data['degt_pend_ene']   = ReportesController::cuenta_documentos($area,$enei,$enef,$status);
        $data['degt_pend_feb']   = ReportesController::cuenta_documentos($area,$febi,$febf,$status);
        $data['degt_pend_mzo']   = ReportesController::cuenta_documentos($area,$mzoi,$mzof,$status);
        $data['degt_pend_abr']   = ReportesController::cuenta_documentos($area,$abri,$abrf,$status);
        $data['degt_pend_may']   = ReportesController::cuenta_documentos($area,$mayi,$mayf,$status);
        $data['degt_pend_jun']   = ReportesController::cuenta_documentos($area,$juni,$junf,$status);
        $data['degt_pend_jul']   = ReportesController::cuenta_documentos($area,$juli,$julf,$status);
        $data['degt_pend_ago']   = ReportesController::cuenta_documentos($area,$agoi,$agof,$status);
        $data['degt_pend_sep']   = ReportesController::cuenta_documentos($area,$sepi,$sepf,$status);
        $data['degt_pend_oct']   = ReportesController::cuenta_documentos($area,$octi,$octf,$status);
        $data['degt_pend_nov']   = ReportesController::cuenta_documentos($area,$novi,$novf,$status);
        $data['degt_pend_dic']   = ReportesController::cuenta_documentos($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['degt_pend']       = ReportesController::cuenta_documentos($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['degt_conc']       = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
//CONTADORES DA 1354
        $area = '1354';
        $data['dacj_pend_ene']   = ReportesController::cuenta_documentos($area,$enei,$enef,$status);
        $data['dacj_pend_feb']   = ReportesController::cuenta_documentos($area,$febi,$febf,$status);
        $data['dacj_pend_mzo']   = ReportesController::cuenta_documentos($area,$mzoi,$mzof,$status);
        $data['dacj_pend_abr']   = ReportesController::cuenta_documentos($area,$abri,$abrf,$status);
        $data['dacj_pend_may']   = ReportesController::cuenta_documentos($area,$mayi,$mayf,$status);
        $data['dacj_pend_jun']   = ReportesController::cuenta_documentos($area,$juni,$junf,$status);
        $data['dacj_pend_jul']   = ReportesController::cuenta_documentos($area,$juli,$julf,$status);
        $data['dacj_pend_ago']   = ReportesController::cuenta_documentos($area,$agoi,$agof,$status);
        $data['dacj_pend_sep']   = ReportesController::cuenta_documentos($area,$sepi,$sepf,$status);
        $data['dacj_pend_oct']   = ReportesController::cuenta_documentos($area,$octi,$octf,$status);
        $data['dacj_pend_nov']   = ReportesController::cuenta_documentos($area,$novi,$novf,$status);
        $data['dacj_pend_dic']   = ReportesController::cuenta_documentos($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['dacj_pend']       = ReportesController::cuenta_documentos($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['dacj_conc']       = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
//CONTADORES DS 1215
        $area = '1215';
        $data['dseg_pend_ene']   = ReportesController::cuenta_documentos($area,$enei,$enef,$status);
        $data['dseg_pend_feb']   = ReportesController::cuenta_documentos($area,$febi,$febf,$status);
        $data['dseg_pend_mzo']   = ReportesController::cuenta_documentos($area,$mzoi,$mzof,$status);
        $data['dseg_pend_abr']   = ReportesController::cuenta_documentos($area,$abri,$abrf,$status);
        $data['dseg_pend_may']   = ReportesController::cuenta_documentos($area,$mayi,$mayf,$status);
        $data['dseg_pend_jun']   = ReportesController::cuenta_documentos($area,$juni,$junf,$status);
        $data['dseg_pend_jul']   = ReportesController::cuenta_documentos($area,$juli,$julf,$status);
        $data['dseg_pend_ago']   = ReportesController::cuenta_documentos($area,$agoi,$agof,$status);
        $data['dseg_pend_sep']   = ReportesController::cuenta_documentos($area,$sepi,$sepf,$status);
        $data['dseg_pend_oct']   = ReportesController::cuenta_documentos($area,$octi,$octf,$status);
        $data['dseg_pend_nov']   = ReportesController::cuenta_documentos($area,$novi,$novf,$status);
        $data['dseg_pend_dic']   = ReportesController::cuenta_documentos($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['dseg_pend']       = ReportesController::cuenta_documentos($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['dseg_conc']       = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
//CONTADORES OM 1027
        $area = '1027';
        $data['om_pend_ene']     = ReportesController::cuenta_documentos($area,$enei,$enef,$status);
        $data['om_pend_feb']     = ReportesController::cuenta_documentos($area,$febi,$febf,$status);
        $data['om_pend_mzo']     = ReportesController::cuenta_documentos($area,$mzoi,$mzof,$status);
        $data['om_pend_abr']     = ReportesController::cuenta_documentos($area,$abri,$abrf,$status);
        $data['om_pend_may']     = ReportesController::cuenta_documentos($area,$mayi,$mayf,$status);
        $data['om_pend_jun']     = ReportesController::cuenta_documentos($area,$juni,$junf,$status);
        $data['om_pend_jul']     = ReportesController::cuenta_documentos($area,$juli,$julf,$status);
        $data['om_pend_ago']     = ReportesController::cuenta_documentos($area,$agoi,$agof,$status);
        $data['om_pend_sep']     = ReportesController::cuenta_documentos($area,$sepi,$sepf,$status);
        $data['om_pend_oct']     = ReportesController::cuenta_documentos($area,$octi,$octf,$status);
        $data['om_pend_nov']     = ReportesController::cuenta_documentos($area,$novi,$novf,$status);
        $data['om_pend_dic']     = ReportesController::cuenta_documentos($area,$dici,$dicf,$status);
    //CONCLUIDOS 3
        $data['tot_conc_om']     = ReportesController::cuenta_documentos($area,$fi,$ff,'3');

//GENERAR REPORTE
        $html  = view('documentos.creaPDF.estadistico',$data)->render();

        $mpdf  = new Mpdf(['format' => 'letter'
                            ,'margin_top'=>20
                            ,'margin_bottom'=>20
                            ,'margin_left'=>20
                            ,'margin_right'=>20
                         ]);
        // Write some HTML code:
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->writeHTML($html); //imprimes la variable $html que contiene tu HTML
        $mpdf->Output($nombreArchivo,'D');//Salida del documento  D
    }

    public function param_sireo()
    {
        return view('documentos.creaPDF.param_sireo');
    }

    public function reporte_sireo(Request $request)
    {
        setlocale(LC_TIME, "spanish");  //FECHA EN ESPANIOL
        $fecha              = date('Y-m-d');
        $data['fecha']      = $fecha;
        $anio               = date('Y');
        $data['anio']       = $anio;
        $parametros         = Parametros::where('ianio','=',$anio)->first();
        $data['parametros'] = $parametros;
        $data['anio_consulta']  = $request->anio_consulta;
        $nombreArchivo = 'estadistico_sireo_'.$fecha.'.pdf';

        $dtfecha_inicial        = DateTime::createFromFormat('d-m-Y', '01-01-'.$request->anio_consulta);
        $fecha_inicial          = $dtfecha_inicial->format("d-m-Y");
        $fi                     = $dtfecha_inicial->format("Y-m-d");
        $data['fecha_inicial']  = $fecha_inicial;
        $dtfecha_final          = DateTime::createFromFormat('d-m-Y', '31-12-'.$request->anio_consulta);
        $fecha_final            = $dtfecha_final->format("d-m-Y");
        $ff                     = $dtfecha_final->format("Y-m-d");
        $data['fecha_final']    = $fecha_final;

//FECHAS POR MES
        $dtenei                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-01-01');
        $dtenef                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-01-31');
        $enei = $dtenei->format("Y-m-d");
        $enef = $dtenef->format("Y-m-d");
        $dtfebi                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-02-01');
        $dtfebf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-02-28');
        $febi = $dtfebi->format("Y-m-d");
        $febf = $dtfebf->format("Y-m-d");
        $dtmzoi                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-03-01');
        $dtmzof                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-03-31');
        $mzoi = $dtmzoi->format("Y-m-d");
        $mzof = $dtmzof->format("Y-m-d");
        $dtabri                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-04-01');
        $dtabrf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-04-30');
        $abri = $dtabri->format("Y-m-d");
        $abrf = $dtabrf->format("Y-m-d");
        $dtmayi                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-05-01');
        $dtmayf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-05-31');
        $mayi = $dtmayi->format("Y-m-d");
        $mayf = $dtmayf->format("Y-m-d");
        $dtjuni                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-06-01');
        $dtjunf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-06-30');
        $juni = $dtjuni->format("Y-m-d");
        $junf = $dtjunf->format("Y-m-d");
        $dtjuli                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-07-01');
        $dtjulf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-07-31');
        $juli = $dtjuli->format("Y-m-d");
        $julf = $dtjulf->format("Y-m-d");
        $dtagoi                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-08-01');
        $dtagof                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-08-31');
        $agoi = $dtagoi->format("Y-m-d");
        $agof = $dtagof->format("Y-m-d");
        $dtsepi                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-09-01');
        $dtsepf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-09-30');
        $sepi = $dtsepi->format("Y-m-d");
        $sepf = $dtsepf->format("Y-m-d");
        $dtocti                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-10-01');
        $dtoctf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-10-31');
        $octi = $dtocti->format("Y-m-d");
        $octf = $dtoctf->format("Y-m-d");
        $dtnovi                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-11-01');
        $dtnovf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-11-30');
        $novi = $dtnovi->format("Y-m-d");
        $novf = $dtnovf->format("Y-m-d");
        $dtdici                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-12-01');
        $dtdicf                 = DateTime::createFromFormat('Y-m-d', $request->anio_consulta.'-12-31');
        $dici = $dtdici->format("Y-m-d");
        $dicf = $dtdicf->format("Y-m-d");

//CONTADORES DERH 231
        $area   = '231';
        $status = '1'; //1=PENDIENTES, 3=CONCLUIDOS
        $data['derh_pend_ene']  = ReportesController::cuenta_sireo($area,$enei,$enef,$status);
        $data['derh_pend_feb']  = ReportesController::cuenta_sireo($area,$febi,$febf,$status);
        $data['derh_pend_mzo']  = ReportesController::cuenta_sireo($area,$mzoi,$mzof,$status);
        $data['derh_pend_abr']  = ReportesController::cuenta_sireo($area,$abri,$abrf,$status);
        $data['derh_pend_may']  = ReportesController::cuenta_sireo($area,$mayi,$mayf,$status);
        $data['derh_pend_jun']  = ReportesController::cuenta_sireo($area,$juni,$junf,$status);
        $data['derh_pend_jul']  = ReportesController::cuenta_sireo($area,$juli,$julf,$status);
        $data['derh_pend_ago']  = ReportesController::cuenta_sireo($area,$agoi,$agof,$status);
        $data['derh_pend_sep']  = ReportesController::cuenta_sireo($area,$sepi,$sepf,$status);
        $data['derh_pend_oct']  = ReportesController::cuenta_sireo($area,$octi,$octf,$status);
        $data['derh_pend_nov']  = ReportesController::cuenta_sireo($area,$novi,$novf,$status);
        $data['derh_pend_dic']  = ReportesController::cuenta_sireo($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['derh_pend']      = ReportesController::cuenta_sireo($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['derh_conc']      = ReportesController::cuenta_sireo($area,$fi,$ff,'3');
//CONTADORES DERF 230
        $area   = '230';
        $data['derf_pend_ene']  = ReportesController::cuenta_sireo($area,$enei,$enef,$status);
        $data['derf_pend_feb']  = ReportesController::cuenta_sireo($area,$febi,$febf,$status);
        $data['derf_pend_mzo']  = ReportesController::cuenta_sireo($area,$mzoi,$mzof,$status);
        $data['derf_pend_abr']  = ReportesController::cuenta_sireo($area,$abri,$abrf,$status);
        $data['derf_pend_may']  = ReportesController::cuenta_sireo($area,$mayi,$mayf,$status);
        $data['derf_pend_jun']  = ReportesController::cuenta_sireo($area,$juni,$junf,$status);
        $data['derf_pend_jul']  = ReportesController::cuenta_sireo($area,$juli,$julf,$status);
        $data['derf_pend_ago']  = ReportesController::cuenta_sireo($area,$agoi,$agof,$status);
        $data['derf_pend_sep']  = ReportesController::cuenta_sireo($area,$sepi,$sepf,$status);
        $data['derf_pend_oct']  = ReportesController::cuenta_sireo($area,$octi,$octf,$status);
        $data['derf_pend_nov']  = ReportesController::cuenta_sireo($area,$novi,$novf,$status);
        $data['derf_pend_dic']  = ReportesController::cuenta_sireo($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['derf_pend']      = ReportesController::cuenta_sireo($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['derf_conc']      = ReportesController::cuenta_sireo($area,$fi,$ff,'3');
//CONTADORES DEOMS 228
        $area   = '228';
        $data['deoms_pend_ene'] = ReportesController::cuenta_sireo($area,$enei,$enef,$status);
        $data['deoms_pend_feb'] = ReportesController::cuenta_sireo($area,$febi,$febf,$status);
        $data['deoms_pend_mzo'] = ReportesController::cuenta_sireo($area,$mzoi,$mzof,$status);
        $data['deoms_pend_abr'] = ReportesController::cuenta_sireo($area,$abri,$abrf,$status);
        $data['deoms_pend_may'] = ReportesController::cuenta_sireo($area,$mayi,$mayf,$status);
        $data['deoms_pend_jun'] = ReportesController::cuenta_sireo($area,$juni,$junf,$status);
        $data['deoms_pend_jul'] = ReportesController::cuenta_sireo($area,$juli,$julf,$status);
        $data['deoms_pend_ago'] = ReportesController::cuenta_sireo($area,$agoi,$agof,$status);
        $data['deoms_pend_sep'] = ReportesController::cuenta_sireo($area,$sepi,$sepf,$status);
        $data['deoms_pend_oct'] = ReportesController::cuenta_sireo($area,$octi,$octf,$status);
        $data['deoms_pend_nov'] = ReportesController::cuenta_sireo($area,$novi,$novf,$status);
        $data['deoms_pend_dic'] = ReportesController::cuenta_sireo($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['deoms_pend']     = ReportesController::cuenta_sireo($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['deoms_conc']     = ReportesController::cuenta_sireo($area,$fi,$ff,'3');
//CONTADORES DEP 229
        $area   = '229';
        $data['dep_pend_ene']   = ReportesController::cuenta_sireo($area,$enei,$enef,$status);
        $data['dep_pend_feb']   = ReportesController::cuenta_sireo($area,$febi,$febf,$status);
        $data['dep_pend_mzo']   = ReportesController::cuenta_sireo($area,$mzoi,$mzof,$status);
        $data['dep_pend_abr']   = ReportesController::cuenta_sireo($area,$abri,$abrf,$status);
        $data['dep_pend_may']   = ReportesController::cuenta_sireo($area,$mayi,$mayf,$status);
        $data['dep_pend_jun']   = ReportesController::cuenta_sireo($area,$juni,$junf,$status);
        $data['dep_pend_jul']   = ReportesController::cuenta_sireo($area,$juli,$julf,$status);
        $data['dep_pend_ago']   = ReportesController::cuenta_sireo($area,$agoi,$agof,$status);
        $data['dep_pend_sep']   = ReportesController::cuenta_sireo($area,$sepi,$sepf,$status);
        $data['dep_pend_oct']   = ReportesController::cuenta_sireo($area,$octi,$octf,$status);
        $data['dep_pend_nov']   = ReportesController::cuenta_sireo($area,$novi,$novf,$status);
        $data['dep_pend_dic']   = ReportesController::cuenta_sireo($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['dep_pend']       = ReportesController::cuenta_sireo($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['dep_conc']       = ReportesController::cuenta_sireo($area,$fi,$ff,'3');
//CONTADORES DERM 232
        $area = '232';
        $data['derm_pend_ene']   = ReportesController::cuenta_sireo($area,$enei,$enef,$status);
        $data['derm_pend_feb']   = ReportesController::cuenta_sireo($area,$febi,$febf,$status);
        $data['derm_pend_mzo']   = ReportesController::cuenta_sireo($area,$mzoi,$mzof,$status);
        $data['derm_pend_abr']   = ReportesController::cuenta_sireo($area,$abri,$abrf,$status);
        $data['derm_pend_may']   = ReportesController::cuenta_sireo($area,$mayi,$mayf,$status);
        $data['derm_pend_jun']   = ReportesController::cuenta_sireo($area,$juni,$junf,$status);
        $data['derm_pend_jul']   = ReportesController::cuenta_sireo($area,$juli,$julf,$status);
        $data['derm_pend_ago']   = ReportesController::cuenta_sireo($area,$agoi,$agof,$status);
        $data['derm_pend_sep']   = ReportesController::cuenta_sireo($area,$sepi,$sepf,$status);
        $data['derm_pend_oct']   = ReportesController::cuenta_sireo($area,$octi,$octf,$status);
        $data['derm_pend_nov']   = ReportesController::cuenta_sireo($area,$novi,$novf,$status);
        $data['derm_pend_dic']   = ReportesController::cuenta_sireo($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['derm_pend']       = ReportesController::cuenta_sireo($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['derm_conc']       = ReportesController::cuenta_sireo($area,$fi,$ff,'3');
//CONTADORES DEGT 227
        $area = '227';
        $data['degt_pend_ene']   = ReportesController::cuenta_sireo($area,$enei,$enef,$status);
        $data['degt_pend_feb']   = ReportesController::cuenta_sireo($area,$febi,$febf,$status);
        $data['degt_pend_mzo']   = ReportesController::cuenta_sireo($area,$mzoi,$mzof,$status);
        $data['degt_pend_abr']   = ReportesController::cuenta_sireo($area,$abri,$abrf,$status);
        $data['degt_pend_may']   = ReportesController::cuenta_sireo($area,$mayi,$mayf,$status);
        $data['degt_pend_jun']   = ReportesController::cuenta_sireo($area,$juni,$junf,$status);
        $data['degt_pend_jul']   = ReportesController::cuenta_sireo($area,$juli,$julf,$status);
        $data['degt_pend_ago']   = ReportesController::cuenta_sireo($area,$agoi,$agof,$status);
        $data['degt_pend_sep']   = ReportesController::cuenta_sireo($area,$sepi,$sepf,$status);
        $data['degt_pend_oct']   = ReportesController::cuenta_sireo($area,$octi,$octf,$status);
        $data['degt_pend_nov']   = ReportesController::cuenta_sireo($area,$novi,$novf,$status);
        $data['degt_pend_dic']   = ReportesController::cuenta_sireo($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['degt_pend']       = ReportesController::cuenta_sireo($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['degt_conc']       = ReportesController::cuenta_sireo($area,$fi,$ff,'3');
//CONTADORES DA 1354
        $area = '1354';
        $data['dacj_pend_ene']   = ReportesController::cuenta_sireo($area,$enei,$enef,$status);
        $data['dacj_pend_feb']   = ReportesController::cuenta_sireo($area,$febi,$febf,$status);
        $data['dacj_pend_mzo']   = ReportesController::cuenta_sireo($area,$mzoi,$mzof,$status);
        $data['dacj_pend_abr']   = ReportesController::cuenta_sireo($area,$abri,$abrf,$status);
        $data['dacj_pend_may']   = ReportesController::cuenta_sireo($area,$mayi,$mayf,$status);
        $data['dacj_pend_jun']   = ReportesController::cuenta_sireo($area,$juni,$junf,$status);
        $data['dacj_pend_jul']   = ReportesController::cuenta_sireo($area,$juli,$julf,$status);
        $data['dacj_pend_ago']   = ReportesController::cuenta_sireo($area,$agoi,$agof,$status);
        $data['dacj_pend_sep']   = ReportesController::cuenta_sireo($area,$sepi,$sepf,$status);
        $data['dacj_pend_oct']   = ReportesController::cuenta_sireo($area,$octi,$octf,$status);
        $data['dacj_pend_nov']   = ReportesController::cuenta_sireo($area,$novi,$novf,$status);
        $data['dacj_pend_dic']   = ReportesController::cuenta_sireo($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['dacj_pend']       = ReportesController::cuenta_sireo($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['dacj_conc']       = ReportesController::cuenta_sireo($area,$fi,$ff,'3');
//CONTADORES DS 1215
        $area = '1215';
        $data['dseg_pend_ene']   = ReportesController::cuenta_sireo($area,$enei,$enef,$status);
        $data['dseg_pend_feb']   = ReportesController::cuenta_sireo($area,$febi,$febf,$status);
        $data['dseg_pend_mzo']   = ReportesController::cuenta_sireo($area,$mzoi,$mzof,$status);
        $data['dseg_pend_abr']   = ReportesController::cuenta_sireo($area,$abri,$abrf,$status);
        $data['dseg_pend_may']   = ReportesController::cuenta_sireo($area,$mayi,$mayf,$status);
        $data['dseg_pend_jun']   = ReportesController::cuenta_sireo($area,$juni,$junf,$status);
        $data['dseg_pend_jul']   = ReportesController::cuenta_sireo($area,$juli,$julf,$status);
        $data['dseg_pend_ago']   = ReportesController::cuenta_sireo($area,$agoi,$agof,$status);
        $data['dseg_pend_sep']   = ReportesController::cuenta_sireo($area,$sepi,$sepf,$status);
        $data['dseg_pend_oct']   = ReportesController::cuenta_sireo($area,$octi,$octf,$status);
        $data['dseg_pend_nov']   = ReportesController::cuenta_sireo($area,$novi,$novf,$status);
        $data['dseg_pend_dic']   = ReportesController::cuenta_sireo($area,$dici,$dicf,$status);
    //PENDIENTES 1
        $data['dseg_pend']       = ReportesController::cuenta_sireo($area,$fi,$ff,$status);
    //CONCLUIDOS 3
        $data['dseg_conc']       = ReportesController::cuenta_sireo($area,$fi,$ff,'3');
//CONTADORES OM 1027
        $area = '1027';
        $data['om_pend_ene']     = ReportesController::cuenta_sireo($area,$enei,$enef,$status);
        $data['om_pend_feb']     = ReportesController::cuenta_sireo($area,$febi,$febf,$status);
        $data['om_pend_mzo']     = ReportesController::cuenta_sireo($area,$mzoi,$mzof,$status);
        $data['om_pend_abr']     = ReportesController::cuenta_sireo($area,$abri,$abrf,$status);
        $data['om_pend_may']     = ReportesController::cuenta_sireo($area,$mayi,$mayf,$status);
        $data['om_pend_jun']     = ReportesController::cuenta_sireo($area,$juni,$junf,$status);
        $data['om_pend_jul']     = ReportesController::cuenta_sireo($area,$juli,$julf,$status);
        $data['om_pend_ago']     = ReportesController::cuenta_sireo($area,$agoi,$agof,$status);
        $data['om_pend_sep']     = ReportesController::cuenta_sireo($area,$sepi,$sepf,$status);
        $data['om_pend_oct']     = ReportesController::cuenta_sireo($area,$octi,$octf,$status);
        $data['om_pend_nov']     = ReportesController::cuenta_sireo($area,$novi,$novf,$status);
        $data['om_pend_dic']     = ReportesController::cuenta_sireo($area,$dici,$dicf,$status);
    //CONCLUIDOS 3
        $data['tot_conc_om']     = ReportesController::cuenta_sireo($area,$fi,$ff,'3');

//GENERAR REPORTE
        $html  = view('documentos.creaPDF.estadistico_sireo',$data)->render();

        $mpdf  = new Mpdf(['format' => 'letter'
                            ,'margin_top'=>20
                            ,'margin_bottom'=>20
                            ,'margin_left'=>20
                            ,'margin_right'=>20
                         ]);
        // Write some HTML code:
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->writeHTML($html); //imprimes la variable $html que contiene tu HTML
        $mpdf->Output($nombreArchivo,'D');//Salida del documento  D
    }

    public function param_consulta()
    {
        return view('documentos.creaPDF.param_consulta');
    }

    public function consulta_estadistica(Request $request)
    {
        setlocale(LC_TIME, "spanish");  //FECHA EN ESPANIOL
        $fecha                  = date('Y-m-d');
        $data['fecha']          = $fecha;
        $anio                   = date('Y');
        $data['anio']           = $anio;
        $parametros             = Parametros::where('ianio','=',$anio)->first();
        $data['parametros']     = $parametros;
        $nombreArchivo          = 'consulta_estadistica_'.$fecha.'.pdf';
        
        $dtfecha_inicial        = DateTime::createFromFormat('d-m-Y', '01-01-'.$request->anio_consulta);
        $fecha_inicial          = $dtfecha_inicial->format("d-m-Y");
        $fi                     = $dtfecha_inicial->format("Y-m-d");
        $data['fecha_inicial']  = $fecha_inicial;
        $dtfecha_final          = DateTime::createFromFormat('d-m-Y', '31-12-'.$request->anio_consulta);
        $fecha_final            = $dtfecha_final->format("d-m-Y");
        $ff                     = $dtfecha_final->format("Y-m-d");
        $data['fecha_final']    = $fecha_final;

//CONTADORES DERH 231
        $area = '231';
    //PENDIENTES 1
        $data['derh_pend']      = ReportesController::cuenta_documentos($area,$fi,$ff,'1');
    //EN PROCESO 2
        $data['derh_proc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'2');
    //CONCLUIDOS 3
        $data['derh_conc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
    //CONOCIMIENTO 4
        $data['derh_cncmt']     = ReportesController::cuenta_documentos($area,$fi,$ff,'4');
//CONTADORES DERF 230
        $area = '230';
    //PENDIENTES 1
        $data['derf_pend']      = ReportesController::cuenta_documentos($area,$fi,$ff,'1');
    //EN PROCESO 2
        $data['derf_proc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'2');
    //CONCLUIDOS 3
        $data['derf_conc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
    //CONOCIMIENTO 4
        $data['derf_cncmt']     = ReportesController::cuenta_documentos($area,$fi,$ff,'4');
//CONTADORES DEOMS 228
        $area = '228';
    //PENDIENTES 1
        $data['deoms_pend']     = ReportesController::cuenta_documentos($area,$fi,$ff,'1');
    //EN PROCESO 2
        $data['deoms_proc']     = ReportesController::cuenta_documentos($area,$fi,$ff,'2');
    //CONCLUIDOS 3
        $data['deoms_conc']     = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
    //CONOCIMIENTO 4
        $data['deoms_cncmt']    = ReportesController::cuenta_documentos($area,$fi,$ff,'4');
//CONTADORES DEP 229
        $area = '229';
    //PENDIENTES 1
        $data['dep_pend']       = ReportesController::cuenta_documentos($area,$fi,$ff,'1');
    //EN PROCESO 2
        $data['dep_proc']       = ReportesController::cuenta_documentos($area,$fi,$ff,'2');
    //CONCLUIDOS 3
        $data['dep_conc']       = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
    //CONOCIMIENTO 4
        $data['dep_cncmt']      = ReportesController::cuenta_documentos($area,$fi,$ff,'4');
//CONTADORES DERM 232
        $area = '232';
    //PENDIENTES 1
        $data['derm_pend']      = ReportesController::cuenta_documentos($area,$fi,$ff,'1');
    //EN PROCESO 2
        $data['derm_proc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'2');
    //CONCLUIDOS 3
        $data['derm_conc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
    //CONOCIMIENTO 4
        $data['derm_cncmt']     = ReportesController::cuenta_documentos($area,$fi,$ff,'4');
//CONTADORES DEGT 227
        $area = '227';
    //PENDIENTES 1
        $data['degt_pend']      = ReportesController::cuenta_documentos($area,$fi,$ff,'1');
    //EN PROCESO 2
        $data['degt_proc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'2');
    //CONCLUIDOS 3
        $data['degt_conc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
    //CONOCIMIENTO 4
        $data['degt_cncmt']     = ReportesController::cuenta_documentos($area,$fi,$ff,'4');
//CONTADORES DA 1354
        $area = '1354';
    //PENDIENTES 1
        $data['dacj_pend']      = ReportesController::cuenta_documentos($area,$fi,$ff,'1');
    //EN PROCESO 2
        $data['dacj_proc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'2');
    //CONCLUIDOS 3
        $data['dacj_conc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
    //CONOCIMIENTO 4
        $data['dacj_cncmt']     = ReportesController::cuenta_documentos($area,$fi,$ff,'4');
//CONTADORES DS 1215
        $area = '1215';
    //PENDIENTES 1
        $data['ds_pend']        = ReportesController::cuenta_documentos($area,$fi,$ff,'1');
    //EN PROCESO 2
        $data['ds_proc']        = ReportesController::cuenta_documentos($area,$fi,$ff,'2');
    //CONCLUIDOS 3
        $data['ds_conc']        = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
    //CONOCIMIENTO 4
        $data['ds_cncmt']       = ReportesController::cuenta_documentos($area,$fi,$ff,'4');
//CONTADORES OTRO 1355
        $area = '1355';
    //PENDIENTES 1
        $data['otro_pend']      = ReportesController::cuenta_documentos($area,$fi,$ff,'1');
    //EN PROCESO 2
        $data['otro_proc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'2');
    //CONCLUIDOS 3
        $data['otro_conc']      = ReportesController::cuenta_documentos($area,$fi,$ff,'3');
    //CONOCIMIENTO 4
        $data['otro_cncmt']     = ReportesController::cuenta_documentos($area,$fi,$ff,'4');

        $html  = view('documentos.creaPDF.consulta_estadistica',$data)->render();

        $mpdf  = new Mpdf(['format' => 'letter'
                            ,'margin_top'=>20
                            ,'margin_bottom'=>20
                            ,'margin_left'=>20
                            ,'margin_right'=>20
                         ]);
        // Write some HTML code:
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->writeHTML($html); //imprimes la variable $html que contiene tu HTML
        $mpdf->Output($nombreArchivo,'D');//Salida del documento  D
    }

    public function param_pendientes()
    {
        return view('documentos.creaPDF.param_pendientes');
    }

    public function consulta_pendientes (Request $request)
    {
        setlocale(LC_TIME, "spanish");  //FECHA EN ESPANIOL
        $fecha                  = date('Y-m-d');
        $data['fecha']          = $fecha;
        $anio                   = date('Y');
        $data['anio']           = $anio;
        $parametros             = Parametros::where('ianio','=',$anio)->first();
        $data['parametros']     = $parametros;
        $nombreArchivo          = 'consulta_pendientes_'.$fecha.'.pdf';
        
        $data['fecha_inicial']  = $request->fecha_inicial;
        $data['fecha_final']    = $request->fecha_final;
        $data['solicitud_a']    = 0;
        if ($request->solicitud_a > 0) {
            switch ($request->solicitud_a) {
                case 227:
                    $data['titulo'] = ', SOLICITUDES A GESTIÓN TECNOLÓGICA';
                    break;
                case 228:
                    $data['titulo'] = ', SOLICITUDES A OBRAS, MANT. Y SERVICIOS';
                    break;
                case 229:
                    $data['titulo'] = ', SOLICITUDES A PLANEACIÓN';
                    break;
                case 230:
                    $data['titulo'] = ', SOLICITUDES A RECURSOS FINANCIEROS';
                    break;
                case 231:
                    $data['titulo'] = ', SOLICITUDES A RECURSOS HUMANOS';
                    break;
                case 232:
                    $data['titulo'] = ', SOLICITUDES A RECURSOS MATERIALES';
                    break;
                case 1215:
                    $data['titulo'] = ', SOLICITUDES A SEGURIDAD';
                    break;
                case 1354:
                    $data['titulo'] = ', SOLICITUDES A DIR. ADMINISTRATIVA';
                    break;
            }
            $data['solicitud_a']    = $request->solicitud_a;
            $total_registros        = DB::table('tadocumentos as d')
                                            ->join('tcpersonal as p','d.iid_personal_remitente', '=', 'p.iid_personal')
                                            ->join('tcpuestos as pst','p.iid_puesto', '=', 'pst.iid_puesto')
                                            ->join('tadestinatarios_atencion as da','d.iid_documento','=','da.iid_documento')
                                            ->where('d.iid_estatus_documento','=',1)
                                            ->where('da.iid_adscripcion','=',$request->solicitud_a)       //SOLICITUD A
                                            ->where('da.iestatus','=',1)
                                            ->whereBetween('dfecha_recepcion',[$request->fecha_inicial,$request->fecha_final])
                                            ->where('d.iestatus','=',1)->count();
        } elseif ($request->solicitud_de > 0) {
            switch ($request->solicitud_de) {
                case 1:
                    $solic_de       = 'Magistrad';
                    $data['titulo'] = ', SOLICITUDES DE MAGISTRADOS';
                    break;
                case 2:
                    $solic_de       = 'Juez';
                    $data['titulo'] = ', SOLICITUDES DE JUECES';
                    break;
                case 3:
                    $solic_de       = 'Consejer';
                    $data['titulo'] = ', SOLICITUDES DE CONSEJEROS';
                    break;
                case 4:
                    $solic_de       = 'Director';
                    $data['titulo'] = ', SOLICITUDES DE DIRECTORES';
                    break;
                case 5:
                    $solic_de       = 'Coordinador';
                    $data['titulo'] = ', SOLICITUDES DE COORDINADORES';
                    break;
            }
            $solicitudes_de         = Puesto::where('cdescripcion_puesto','like',$solic_de.'%')->where('iestatus','=',1)->get();
            foreach($solicitudes_de as $sol_de)
                $array_solic_de[]   = $sol_de->iid_puesto;
            $total_registros        = Documento::with('personalremitente')
                                               ->join('tcpersonal','tadocumentos.iid_personal_remitente', '=', 'tcpersonal.iid_personal')
                                               ->join('tcpuestos','tcpersonal.iid_puesto', '=', 'tcpuestos.iid_puesto')
                                               ->where('tadocumentos.iid_estatus_documento','=',1)
                                               ->whereIn('tcpersonal.iid_puesto',$array_solic_de)                               //SOLICITUD DE
                                               ->whereBetween('dfecha_recepcion',[$request->fecha_inicial,$request->fecha_final])
                                               ->where('tadocumentos.iestatus','=',1)->count();
        } else {
            $data['titulo']         = '';
            $total_registros        = Documento::with('personalremitente')
                                               ->join('tcpersonal','tadocumentos.iid_personal_remitente', '=', 'tcpersonal.iid_personal')
                                               ->join('tcpuestos','tcpersonal.iid_puesto', '=', 'tcpuestos.iid_puesto')
                                               ->where('tadocumentos.iid_estatus_documento','=',1)
                                               ->whereBetween('dfecha_recepcion',[$request->fecha_inicial,$request->fecha_final])
                                               ->where('tadocumentos.iestatus','=',1)->count();
        }
        if ($total_registros==0) {
            return redirect()->route('reportes.param_pendientes')
                         ->with('success','NO HAY INFORMACIÓN PARA ESTOS PARÁMETROS, PRUEBE CON OTROS.');
        }
        $salto_registros        = 5;
        $data['salto_registros']= $salto_registros;
        if(fmod($total_registros, $salto_registros)==0.0)
            $total_paginas          = intdiv($total_registros, $salto_registros);
        else
            $total_paginas          = intdiv($total_registros, $salto_registros) + 1;
        $salto_paginas          = 0;

        for($i=1; $i<=$total_paginas; $i++) {
            $data['i']              = $i;
            $data['salto_paginas']  = $salto_paginas;
            $data['total_paginas']  = $total_paginas;
            if ($request->solicitud_a > 0) {
                $data['pendientes']     = DB::table('tadocumentos as d')
                                            ->join('tcpersonal as p','d.iid_personal_remitente', '=', 'p.iid_personal')
                                            ->join('tcpuestos as pst','p.iid_puesto', '=', 'pst.iid_puesto')
                                            ->join('tadestinatarios_atencion as da','d.iid_documento','=','da.iid_documento')
                                            ->where('d.iid_estatus_documento','=',1)
                                            ->where('da.iid_adscripcion','=',$request->solicitud_a)       //SOLICITUD A
                                            ->where('da.iestatus','=',1)
                                            ->whereBetween('dfecha_recepcion',[$request->fecha_inicial,$request->fecha_final])
                                            ->where('d.iestatus','=',1)->skip($salto_paginas)->take($salto_registros)->get();
            } elseif ($request->solicitud_de > 0) {
                $data['pendientes']     = Documento::with('personalremitente')
                                                   ->join('tcpersonal','tadocumentos.iid_personal_remitente', '=', 'tcpersonal.iid_personal')
                                                   ->join('tcpuestos','tcpersonal.iid_puesto', '=', 'tcpuestos.iid_puesto')
                                                   ->where('tadocumentos.iid_estatus_documento','=',1)
                                                   ->whereIn('tcpersonal.iid_puesto',$array_solic_de)                               //SOLICITUD DE
                                                   ->whereBetween('dfecha_recepcion',[$request->fecha_inicial,$request->fecha_final])
                                                   ->where('tadocumentos.iestatus','=',1)->skip($salto_paginas)->take($salto_registros)->get();
            } else {
                $data['pendientes']     = Documento::with('personalremitente')
                                                   ->join('tcpersonal','tadocumentos.iid_personal_remitente', '=', 'tcpersonal.iid_personal')
                                                   ->join('tcpuestos','tcpersonal.iid_puesto', '=', 'tcpuestos.iid_puesto')
                                                   ->where('tadocumentos.iid_estatus_documento','=',1)
                                                   ->whereBetween('dfecha_recepcion',[$request->fecha_inicial,$request->fecha_final])
                                                   ->where('tadocumentos.iestatus','=',1)->skip($salto_paginas)->take($salto_registros)->get();
            }
            $html[$i]               = view('documentos.creaPDF.consulta_pendientes',$data)->render();
            $salto_paginas          = $salto_paginas + $salto_registros;
        }

        $mpdf  = new Mpdf(['format' => 'letter'
                            ,'orientation'=>'L'
                            ,'margin_top'=>10
                            ,'margin_bottom'=>10
                            ,'margin_left'=>10
                            ,'margin_right'=>10
                         ]);
        // Write some HTML code:
        $mpdf->SetDisplayMode('fullpage');
        for($i=1; $i<=$total_paginas; $i++) {
            $mpdf->writeHTML($html[$i]); //imprimes la variable $html que contiene tu HTML
            if ($i < $total_paginas)
                $mpdf->AddPage();
        }
        $mpdf->Output($nombreArchivo,'D');//Salida del documento  D
    }

    public function param_exportar()
    {
        return view('documentos.creaPDF.param_exportar');
    }

    public static function cuenta_documentos($area,$fi,$ff,$status)
    {
        $contador = Documento::join('tadestinatarios_atencion','tadestinatarios_atencion.iid_documento','=','tadocumentos.iid_documento')
                             ->where('tadestinatarios_atencion.iid_adscripcion','=',$area)
                             ->where('tadocumentos.iid_estatus_documento','=',$status)
                             ->whereBetween('tadocumentos.dfecha_recepcion',[$fi,$ff])
                             ->where('tadocumentos.iestatus','=',1)->count();
        return $contador;
    }

    public static function cuenta_sireo($area,$fi,$ff,$status)
    {
        $contador = Documento::join('tadestinatarios_atencion','tadestinatarios_atencion.iid_documento','=','tadocumentos.iid_documento')
                             ->where('tadestinatarios_atencion.iid_adscripcion','=',$area)
                             ->where('tadocumentos.iid_estatus_documento','=',$status)
                             ->whereIn('tadocumentos.iid_tipo_documento',[1,2,10,12,13])
                             ->whereBetween('tadocumentos.dfecha_recepcion',[$fi,$ff])
                             ->where('tadocumentos.iestatus','=',1)->count();
        return $contador;
    }
}
