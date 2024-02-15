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

use App\Exports\Excel\DocumentosExport;
use Maatwebsite\Excel\Facades\Excel;

use Mpdf\Mpdf;

use \stdClass;
use \Datetime;
use \DateInterval;

class DocumentosController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

    public function index(Request $request)
    {
        $folio  = $request->folio;
        $docto  = $request->docto;
        $asunto = $request->asunto;
        if ($folio != "") {
            $data['documentos'] = Documento::with('tipodocumento','tipoanexo','estatusdocumento','prioridaddocumento','semaforodocumento','importanciacontenido','tema','tipoasunto','instruccion','personalremitente','personalconocimiento','destinatarioatencion','destinatarioconocimiento')->where('cfolio','like','%'.$folio.'%')->where('iestatus','=',1)->orderBy('iid_semaforo')->get();
        } elseif ($docto != "") {
            $data['documentos'] = Documento::with('tipodocumento','tipoanexo','estatusdocumento','prioridaddocumento','semaforodocumento','importanciacontenido','tema','tipoasunto','instruccion','personalremitente','personalconocimiento','destinatarioatencion','destinatarioconocimiento')->where('cnumero_documento','like','%'.$docto.'%')->where('iestatus','=',1)->orderBy('iid_semaforo')->get();
        } elseif ($asunto != "") {
            $data['documentos'] = Documento::with('tipodocumento','tipoanexo','estatusdocumento','prioridaddocumento','semaforodocumento','importanciacontenido','tema','tipoasunto','instruccion','personalremitente','personalconocimiento','destinatarioatencion','destinatarioconocimiento')->where('casunto','like','%'.$asunto.'%')->where('iestatus','=',1)->orderBy('iid_semaforo')->get();
        } else {
            $data['documentos'] = Documento::with('tipodocumento','tipoanexo','estatusdocumento','prioridaddocumento','semaforodocumento','importanciacontenido','tema','tipoasunto','instruccion','personalremitente','personalconocimiento','destinatarioatencion','destinatarioconocimiento')->where('iestatus','=',1)->orderBy('iid_semaforo')->latest()->take(200)->get();
        }
        return view('documentos.index',$data);
    }

    public function nuevo_documento()
    {
        $documento         = new Documento();
        $anio              = Date('Y');
        $parametros        = Parametros::where('ianio','=',$anio)->first();
        $listTipoDocumento = TipoDocumento::where('iestatus','=',1)->orderBy('cdescripcion_tipo_documento')->get();
        $listTipoAnexo     = TipoAnexo::where('iestatus','=',1)->get();
        $listEstatus       = EstatusDocumento::where('iestatus','=',1)->get();
        $listPrioridad     = PrioridadDocumento::where('iestatus','=',1)->get();
        $listSemaforo      = Semaforo::where('iestatus','=',1)->get();
        $listPersonal      = Personal::where('iestatus','=',1)->get();
        $listPuesto        = Puesto::where('iestatus','=',1)->orderBy('cdescripcion_puesto')->get();
        $listAdscripcion   = Adscripcion::where('iestatus','=',1)->orderBy('cdescripcion_adscripcion')->get();
        $listTipoArea       = TipoArea::where('iestatus','=',1)->get();
        $listImportancia   = ImportanciaContenido::where('iestatus','=',1)->get();
        $listTema          = Tema::where('iestatus','=',1)->get();
        $listAsunto        = TipoAsunto::where('iestatus','=',1)->get();
        $listInstruccion   = Instruccion::where('iestatus','=',1)->get();
        $listDestinAtn     = Adscripcion::where('iid_tipo_area','=',4)->where('iestatus','=',1)->get();
        $listDestinConoc   = Adscripcion::where('iid_tipo_area','=',4)->where('iestatus','=',1)->get();
    //CALCULAR ÚLTIMOS FOLIOS Y SUGERIRLOS EN LA CAPTURA
        $newfolio          = $parametros->iultimo_folio + 1;
        $newfolio          = str_pad($newfolio, 5, "0", STR_PAD_LEFT);
        $newfolio          = $newfolio.'-'.substr($anio,2,2);
        $newfolio_rh       = $parametros->iultimo_folio_rh + 1;
        $newfolio_rh       = str_pad($newfolio_rh, 5, "0", STR_PAD_LEFT);
        $newfolio_rh       = $newfolio_rh.'-RH'.substr($anio,2,2);
        $newfolio_cc       = $parametros->iultimo_folio_cc + 1;
        $newfolio_cc       = str_pad($newfolio_cc, 5, "0", STR_PAD_LEFT);
        $newfolio_cc       = $newfolio_cc.'-CC'.substr($anio,2,2);
        $destinAtt         = new DestinatarioAtencion();
        $destinCon         = new DestinatarioConocimiento();
        $folioRel          = new FolioRelacionado();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar          = '';
        //Auxiliar para que pinte Checkboxes, si nuevo_registro=1, entonces van sin checkear
        $nuevo_registro     = '1';
        return view('documentos.nuevo',compact('documento','listTipoDocumento','listTipoAnexo','listEstatus','listPrioridad','listSemaforo','listPersonal','listPuesto','listAdscripcion','listTipoArea','listImportancia','listTema','listAsunto','listInstruccion','listDestinAtn','listDestinConoc','parametros','newfolio','newfolio_rh','newfolio_cc','destinAtt','destinCon','folioRel','noeditar','nuevo_registro'));
    }

    public function guardar_documento(Request $request)
    {
        $now  = new \DateTime();
        $anio = Date('Y');
        $documento                              = new Documento();
        $parametros                             = Parametros::where('ianio','=',$anio)->first();
        $jsonBefore                             = "NEW INSERT DOCUMENTO";

    //CAPTURA MANUAL DEL FOLIO, VALIDACIONES
        //Revisar que no exista un Documento con el mismo Folio.
        $ya_existe_folio                        = Documento::where('cfolio','=',$request->folio_documento)->where('iestatus','=',1)->count();
        //Si no hay, entonces agregar a Documentos con el Folio capturado.
        if ($ya_existe_folio==0) {
            $documento->cfolio                  = $request->folio_documento;
        } else {
    //REGISTRO AUTOMÁTICO DEL FOLIO, RECALCULAR ÚLTIMO FOLIO
            if($request->tipo_documento<=6 || $request->tipo_documento>=9) {
                $newfolio                               = $parametros->iultimo_folio + 1;
                $newfolio                               = str_pad($newfolio, 5, "0", STR_PAD_LEFT);
                $newfolio                               = $newfolio.'-'.substr($parametros->ianio,2,2);
            } elseif($request->tipo_documento==7) {
                $newfolio_cc                            = $parametros->iultimo_folio_cc + 1;
                $newfolio_cc                            = str_pad($newfolio_cc, 5, "0", STR_PAD_LEFT);
                $newfolio_cc                            = $newfolio_cc.'-CC'.substr($parametros->ianio,2,2);
            } elseif($request->tipo_documento==8) {
                $newfolio_rh                            = $parametros->iultimo_folio_rh + 1;
                $newfolio_rh                            = str_pad($newfolio_rh, 5, "0", STR_PAD_LEFT);
                $newfolio_rh                            = $newfolio_rh.'-RH'.substr($parametros->ianio,2,2);
            }
            if($request->tipo_documento<=6 || $request->tipo_documento>=9) 
                $documento->cfolio                  = $newfolio;
            elseif($request->tipo_documento==7)
                $documento->cfolio                  = $newfolio_cc;
            elseif($request->tipo_documento==8)
                $documento->cfolio                  = $newfolio_rh;
        }
    //FIN DE VALIDACIONES DE LA CAPTURA MANUAL DEL FOLIO
        $documento->dfecha_recepcion            = $request->recepcion_documento;
        $documento->cnumero_documento           = $request->numero_documento;
        $documento->dfecha_documento            = $request->fecha_documento;
        $documento->iid_tipo_documento          = $request->tipo_documento;
        $documento->iid_tipo_anexo              = $request->tipo_anexo;
        $documento->cotro_tipo_anexo            = $request->otro_tipo_anexo;
        $documento->iid_estatus_documento       = $request->estatus_documento;
        $documento->iid_prioridad_documento     = $request->prioridad_documento;
        $documento->iid_semaforo                = $request->semaforo;
        $documento->cnomenclatura_archivistica  = $request->nomenclatura_archivistica;
        $documento->iid_importancia_contenido   = $request->importancia_contenido;
        $documento->iid_tema                    = $request->tema;
        $documento->iid_tipo_asunto             = $request->tipo_asunto;
        $documento->cotro_tipo_asunto           = $request->otro_tipo_asunto;
        $documento->iid_instruccion             = $request->instruccion;
        $documento->dfecha_termino              = $request->fecha_termino;
        $documento->casunto                     = $request->asunto;
        $documento->cobservaciones              = $request->observaciones;
//GUARDAR DATOS DE OTRO PERSONAL REMITENTE QUE NO ESTÉ EN EL CATÁLOGO
        if($request->markOtro==='on') {
    //Guardar Nuevo Puesto
            if ($request->otra_desc_puesto!="")
                $idPuesto = DocumentosController::busca_puesto($request->otra_desc_puesto);
    //Guardar Nueva Adscripción
            if ($request->otra_desc_adsc!="" && $request->nvo_tipo_adscripcion!="")
                $idAdscrip= DocumentosController::busca_adscripcion($request->otra_desc_adsc, $request->nvo_tipo_adscripcion);
    //Guardar Nuevo Personal
            if ($request->nuevo_nombre!="" && $request->otro_paterno!=""){
        //Revisar que no exista una persona con el mismo Nombre y Apellidos
                $ya_hay_pers                                     = Personal::where('cnombre_personal','=',$request->nuevo_nombre)
                                                                       ->where('cpaterno_personal','=',$request->otro_paterno)
                                                                       ->where('cmaterno_personal','=',$request->otro_materno)
                                                                       ->where('iestatus','=',1)->count();
        //Si no hay, entonces agregar al catálogo
                if ($ya_hay_pers==0) {
                    $nuevo_personal                              = new Personal();
                    $jsonBeforeNvoPersonal                       = "NEW INSERT PERSONAL";
                    $nuevo_personal->cnombre_personal            = $request->nuevo_nombre;
                    $nuevo_personal->cpaterno_personal           = $request->otro_paterno;
                    $nuevo_personal->cmaterno_personal           = $request->otro_materno;
                //GUARDAR CLAVE DE PUESTO
                    if($request->otra_desc_puesto!="")
                        $nuevo_personal->iid_puesto              = $idPuesto;                       //ID PUESTO NUEVO/EXISTENTE EN BD
                    elseif ($request->otro_nvo_puesto!="")
                        $nuevo_personal->iid_puesto              = $request->otro_nvo_puesto;       //ID PUESTO EXISTENTE DE LA LISTA
                //GUARDAR CLAVE DE ADSCRIPCION
                    if($request->otra_desc_adsc!="")
                        $nuevo_personal->iid_adscripcion         = $idAdscrip;                      //ID ADSCRIP. NUEVA/EXISTENTE EN BD
                    elseif ($request->otra_nva_adscripcion!="")
                        $nuevo_personal->iid_adscripcion         = $request->otra_nva_adscripcion;  //ID ADSCRIP. EXISTENTE DE LA LISTA
                    $nuevo_personal->iestatus                    = 1;
                    $nuevo_personal->iid_usuario                 = auth()->user()->id;
                    $nuevo_personal->save();
                    $jsonAfterNvoPersonal                        = json_encode($nuevo_personal);
                    PersonalController::bitacora($jsonBeforeNvoPersonal,$jsonAfterNvoPersonal);
                }
            }
            $documento->iid_personal_remitente  = $nuevo_personal->iid_personal;
        } else {
            $documento->iid_personal_remitente  = $request->idRemitente;
        }

    //Manejo del archivo PDF
        if($request->hasFile("archivo")){
            $file=$request->file("archivo");
            
            $nombre = "pdf_".time().".".$file->guessExtension();

            $ruta = public_path("pdf/".$nombre);

            if($file->guessExtension()=="pdf"){
                copy($file, $ruta);
                $documento->cruta_archivo_documento = $ruta;
            }else{
                $documento->cruta_archivo_documento = '';
                dd("NO ES UN PDF");
            }
        }
        //Fin de Manejo del archivo PDF

        $documento->iestatus                    = 1;
        $documento->iid_usuario                 = auth()->user()->id;
        $documento->save();
        //Obtener el último registro guardado en Documentos
        $idDocumento                            = $documento->iid_documento;
        $jsonAfter                              = json_encode($documento);
        DocumentosController::bitacora($jsonBefore,$jsonAfter);

    //ACTUALIZAR ULTIMOS FOLIOS EN LA TABLA PARÁMETROS
        if($request->tipo_documento<=6 || $request->tipo_documento>=9) {
            if ($request->folio_documento>$parametros->iultimo_folio) {
                if ($ya_existe_folio==0) 
                    $parametros->iultimo_folio    = ltrim(substr($request->folio_documento,0,5),'0');   //REGISTRO MANUAL DEL FOLIO
                else
                    $parametros->iultimo_folio    = $parametros->iultimo_folio + 1;     //REGISTRO AUTOMÁTICO DEL FOLIO, RECALCULAR ÚLTIMO FOLIO
            } else {
                if ($ya_existe_folio>0)
                    $parametros->iultimo_folio    = $parametros->iultimo_folio + 1;     //REGISTRO AUTOMÁTICO DEL FOLIO, RECALCULAR ÚLTIMO FOLIO
            }
        } elseif($request->tipo_documento==7) {
            if ($request->folio_documento>$parametros->iultimo_folio_cc) {
                if ($ya_existe_folio==0)
                    $parametros->iultimo_folio_cc = ltrim(substr($request->folio_documento,0,5),'0');   //REGISTRO MANUAL DEL FOLIO
                else
                    $parametros->iultimo_folio_cc = $parametros->iultimo_folio_cc + 1;  //REGISTRO AUTOMÁTICO DEL FOLIO, RECALCULAR ÚLTIMO FOLIO
            } else {
                if ($ya_existe_folio>0)
                    $parametros->iultimo_folio    = $parametros->iultimo_folio_cc + 1;  //REGISTRO AUTOMÁTICO DEL FOLIO, RECALCULAR ÚLTIMO FOLIO
            }
        } elseif($request->tipo_documento==8) {
            if ($request->folio_documento>$parametros->iultimo_folio_rh) {
                if ($ya_existe_folio==0)
                    $parametros->iultimo_folio_rh = ltrim(substr($request->folio_documento,0,5),'0');   //REGISTRO MANUAL DEL FOLIO
                else
                    $parametros->iultimo_folio_rh = $parametros->iultimo_folio_rh + 1;  //REGISTRO AUTOMÁTICO DEL FOLIO, RECALCULAR ÚLTIMO FOLIO
            } else {
                if ($ya_existe_folio>0)
                    $parametros->iultimo_folio    = $parametros->iultimo_folio_rh + 1;  //REGISTRO AUTOMÁTICO DEL FOLIO, RECALCULAR ÚLTIMO FOLIO
            }
        }
        $parametros->save();

        //Folios Relacionados
        if($request->folio_relacionado!="")
            FolioRelacionadoController::guarda_folio_relacionado($idDocumento, $request->folio_relacionado);

        //Destinatarios de Copia de Conocimiento
        if($request->nombre_destinatariocc>0)
            PersonalConocimientoController::guarda_personal_conoc($idDocumento, $request->idDestinatario);


        if ($request->tipo_documento<=6 || $request->tipo_documento>=9) {
    //Guardar Destinatarios para ATENCIÓN
            /*
            if($request->atencion2==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '1027');  //OM
            */
            if($request->atencion12==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '229');   //DEP
            if($request->atencion14==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '227');   //DEGT
            if($request->atencion15==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '231');   //DERH
            if($request->atencion16==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '228');   //DEOMS
            if($request->atencion17==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '232');   //DERM
            if($request->atencion18==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '230');   //DERF
            if($request->atencion19==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '1215');  //DS
            if($request->atencion20==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '1354');  //DA CJPJCD
            if($request->atencion21==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '1208');  //DGJ
            //OTRO
            if($request->atencion999==='on'){
    //Guardar OTRO Personal que ya Existe en el Catálogo
                if (($request->idOtroPersonal!="" && $request->idOtroPuesto!="" && $request->idOtraAdscrip!="") && 
                ($request->nuevo_nombre_ac=="" && $request->otro_paterno_ac=="" && $request->otra_desc_puesto_ac=="" && 
                $request->otra_desc_adsc_ac=="" && $request->nvo_tipo_adscripcion_ac==""))
                    DestinatarioAtencionController::guarda_otra_persona($idDocumento,$request->idOtroPuesto,$request->idOtraAdscrip,$request->idOtroPersonal);

    //GUARDAR OTRO PERSONAL NUEVO, CON PUESTO NUEVO/YA EXISTE Y ADSCRIPCIÓN NUEVA/YA EXISTE
    //Guardar Nuevo Puesto
                if ($request->otra_desc_puesto_ac!="")
                    $idPuesto_ac = DocumentosController::busca_puesto($request->otra_desc_puesto_ac);
    //Guardar Nueva Adscripción
                if ($request->otra_desc_adsc_ac!="" && $request->nvo_tipo_adscripcion_ac!="")
                    $idAdscrip_ac= DocumentosController::busca_adscripcion($request->otra_desc_adsc_ac, $request->nvo_tipo_adscripcion_ac);
    //Guardar Nuevo Personal
                if ($request->nuevo_nombre_ac!="" && $request->otro_paterno_ac!=""){
            //Revisar que no exista una persona con el mismo Nombre y Apellidos
                    $ya_hay_pers                                     = Personal::where('cnombre_personal','=',$request->nuevo_nombre_ac)
                                                                           ->where('cpaterno_personal','=',$request->otro_paterno_ac)
                                                                           ->where('cmaterno_personal','=',$request->otro_materno_ac)
                                                                           ->where('iestatus','=',1)->count();
            //Si no hay, entonces agregar al catálogo
                    if ($ya_hay_pers==0) {
                        $nuevo_personal                              = new Personal();
                        $jsonBeforeNvoPersonal                       = "NEW INSERT PERSONAL";
                        $nuevo_personal->cnombre_personal            = $request->nuevo_nombre_ac;
                        $nuevo_personal->cpaterno_personal           = $request->otro_paterno_ac;
                        $nuevo_personal->cmaterno_personal           = $request->otro_materno_ac;
                    //GUARDAR CLAVE DE PUESTO
                        if($request->otra_desc_puesto_ac!="")
                            $nuevo_personal->iid_puesto              = $idPuesto_ac;                        //ID PUESTO NUEVO/EXISTENTE EN BD
                        elseif ($request->otro_nvo_puesto_ac!="")
                            $nuevo_personal->iid_puesto              = $request->otro_nvo_puesto_ac;        //ID PUESTO EXISTENTE DE LA LISTA
                    //GUARDAR CLAVE DE ADSCRIPCION
                        if($request->otra_desc_adsc_ac!="")
                            $nuevo_personal->iid_adscripcion         = $idAdscrip_ac;                       //ID ADSCRIP. NUEVA/EXISTENTE EN BD
                        elseif ($request->otra_nva_adscripcion_ac!="")
                            $nuevo_personal->iid_adscripcion         = $request->otra_nva_adscripcion_ac;   //ID ADSCRIP. EXISTENTE DE LA LISTA
                        $nuevo_personal->iestatus                    = 1;
                        $nuevo_personal->iid_usuario                 = auth()->user()->id;
                        $nuevo_personal->save();
                        $jsonAfterNvoPersonal                        = json_encode($nuevo_personal);
                        PersonalController::bitacora($jsonBeforeNvoPersonal,$jsonAfterNvoPersonal);
                        DestinatarioAtencionController::guarda_otra_persona($idDocumento,$nuevo_personal->iid_puesto,$nuevo_personal->iid_adscripcion,$nuevo_personal->iid_personal);
                    }
                }
            }
        }
        if($request->tipo_documento==8) {
            if($request->atencion_presidente==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '1031');  //PRESIDENCIA
            if($request->atencion_oficialmayor==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '1027');  //OM
            if($request->atencion_da==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '1354');  //DA
            if($request->atencion_derh==='on')
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '231');   //DERH
        }

        if ($request->tipo_documento<=6 || $request->tipo_documento>=9) {
    //Guardar Destinatarios para Conocimiento
            /*
            if($request->conoc2==='on')
                DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '1027');  //OM
            */
            if($request->conoc12==='on')
                DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '229');   //DEP
            if($request->conoc14==='on')
                DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '227');   //DEGT
            if($request->conoc15==='on')
                DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '231');   //DERH
            if($request->conoc16==='on')
                DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '228');   //DEOMS
            if($request->conoc17==='on')
                DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '232');   //DERM
            if($request->conoc18==='on')
                DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '230');   //DERF
            if($request->conoc19==='on')
                DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '1215');  //DS
            if($request->conoc20==='on')
                DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '1354');  //DA CJPJCD
            if($request->conoc21==='on')
                DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '1208');  //DGJ
            //OTRO
            if($request->conoc999==='on') {
    //Guardar OTRO Personal que ya Existe en el Catálogo
                if (($request->idOtroPersonal!="" && $request->idOtroPuesto!="" && $request->idOtraAdscrip!="") &&
                ($request->nuevo_nombre_ac=="" && $request->otro_paterno_ac=="" && $request->otra_desc_puesto_ac=="" && 
                $request->otra_desc_adsc_ac=="" && $request->nvo_tipo_adscripcion_ac==""))
                    DestinatarioConocimientoController::guarda_otra_persona($idDocumento,$request->idOtroPuesto,$request->idOtraAdscrip,$request->idOtroPersonal);
            
    //Guardar Nuevo Puesto
                if ($request->otra_desc_puesto_ac!="")
                    $idPuesto_ac = DocumentosController::busca_puesto($request->otra_desc_puesto_ac);
    //Guardar Nueva Adscripción
                if ($request->otra_desc_adsc_ac!="" && $request->nvo_tipo_adscripcion_ac!="")
                    $idAdscrip_ac= DocumentosController::busca_adscripcion($request->otra_desc_adsc_ac, $request->nvo_tipo_adscripcion_ac);
    //Guardar Nuevo Personal
                if ($request->nuevo_nombre_ac!="" && $request->otro_paterno_ac!=""){
        //Revisar que no exista una persona con el mismo Nombre y Apellidos
                    $ya_hay_pers                                     = Personal::where('cnombre_personal','=',$request->nuevo_nombre_ac)
                                                                           ->where('cpaterno_personal','=',$request->otro_paterno_ac)
                                                                           ->where('cmaterno_personal','=',$request->otro_materno_ac)
                                                                           ->where('iestatus','=',1)->count();
        //Si no hay, entonces agregar al catálogo
                    if ($ya_hay_pers==0) {
                        $nuevo_personal                              = new Personal();
                        $jsonBeforeNvoPersonal                       = "NEW INSERT PERSONAL";
                        $nuevo_personal->cnombre_personal            = $request->nuevo_nombre_ac;
                        $nuevo_personal->cpaterno_personal           = $request->otro_paterno_ac;
                        $nuevo_personal->cmaterno_personal           = $request->otro_materno_ac;
                //GUARDAR CLAVE DE PUESTO
                        if ($request->otra_desc_puesto_ac!="")
                            $nuevo_personal->iid_puesto              = $idPuesto_ac;                        //ID PUESTO NUEVO/EXISTENTE EN BD
                        elseif ($request->otro_nvo_puesto_ac!="")
                            $nuevo_personal->iid_puesto              = $request->otro_nvo_puesto_ac;        //ID PUESTO EXISTENTE DE LA LISTA
                //GUARDAR CLAVE DE ADSCRIPCION
                        if ($request->otra_desc_adsc_ac!="")
                            $nuevo_personal->iid_adscripcion         = $idAdscrip_ac;                       //ID ADSCRIP. NUEVA/EXISTENTE EN BD
                        elseif ($request->otra_nva_adscripcion_ac!="")
                            $nuevo_personal->iid_adscripcion         = $request->otra_nva_adscripcion_ac;   //ID ADSCRIP. EXISTENTE DE LA LISTA
                        $nuevo_personal->iestatus                    = 1;
                        $nuevo_personal->iid_usuario                 = auth()->user()->id;
                        $nuevo_personal->save();
                        $jsonAfterNvoPersonal                        = json_encode($nuevo_personal);
                        PersonalController::bitacora($jsonBeforeNvoPersonal,$jsonAfterNvoPersonal);
                        DestinatarioConocimientoController::guarda_otra_persona($idDocumento,$nuevo_personal->iid_puesto,$nuevo_personal->iid_adscripcion,$nuevo_personal->iid_personal);
                    }
                }
            }
        }

        //return redirect()->route('documentos.index')
          //               ->with('success','Documento guardado satisfactoriamente');
        return redirect()->route('documentos.editar',$idDocumento)
                         ->with('success','Documento guardado satisfactoriamente');
    }

    public function acuse_documento($id_documento)
    {
        setlocale(LC_TIME, "spanish");  //FECHA EN ESPANIOL
        $fecha              = date('Y-m-d');
        $anio               = date('Y');
        $docto              = Documento::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->first();
//Datos de Destinatario Atención
        if ($docto->iid_tipo_documento==8) {
            $destinAtt_total    = DestinatarioAtencion::where('iid_documento','=',$id_documento)
                                                      ->whereIn('iid_adscripcion',[231,1354])
                                                      ->where('iestatus','=',1)->count();
        } else {
            $destinAtt_total    = DestinatarioAtencion::where('iid_documento','=',$id_documento)
                                                      ->where('iestatus','=',1)->count();
        }
        $data['destinAtt_total'] = $destinAtt_total;
        if($destinAtt_total>0) {
            if ($docto->iid_tipo_documento==8) {
                $destinAtt      = DestinatarioAtencion::with('adscripcion')
                                                      ->where('iid_documento','=',$id_documento)
                                                      ->whereIn('iid_adscripcion',[231,1354])
                                                      ->where('iestatus','=',1)->get();
            } else {
                $destinAtt      = DestinatarioAtencion::with('adscripcion')
                                                      ->where('iid_documento','=',$id_documento)
                                                      ->where('iestatus','=',1)->get();
            }
            //dd($destinAtt);
        } else {
            $destinAtt      = new DestinatarioAtencion();
        }
//Y convertirla en un arreglo
        $array1 = array();
    //Arreglo auxiliar, para solamente traer los Directores Ejecutivos (1384 DEP,1718 DEGT,1771 DEOMS,1772 DERM,1775 DERF,1822 DERH), 
    //el Oficial Mayor 213, el Dir. de Seguridad 1860, el Presidente 62 del TSJ, y el de la Dir. Administrativa del CJ 1859
        //$array2             = [62,213,1384,1718,1771,1772,1775,1822,1859,1860];
    //Arreglo auxiliar, para solamente traer los ID PUESTOS de los Directores Ejecutivos, DA, DS, DGJ
        $array2             = [101,102,103,139,141,614,844,635, 146];
        if($destinAtt_total>0){
            foreach($destinAtt as $destAten) {
                if ($destAten->iid_adscripcion==1355) {
                    $array1[]   = $destAten->iid_otra_adscripcion;
                    $array2[]   = $destAten->iid_otro_puesto;
                } else {
                    $array1[]   = $destAten->iid_adscripcion;
                }
            }
        }
    //Para poder usarla en la consulta de Personal Destinatario Atención
        $pers_destAt        = Personal::with('puesto','adscripcion')->whereIn('iid_adscripcion',$array1)
                                                                  //->whereIn('iid_personal',$array2)
                                                                    ->whereIn('iid_puesto',$array2)
                                                                    ->where('iestatus','=',1)->get();
        $data['pers_destAt']= $pers_destAt;

//Datos de Destinatarios Conocimiento
        $destinCon_total    = DestinatarioConocimiento::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->count();
        $data['destinCon_total'] = $destinCon_total;
        if($destinCon_total>0)
            $destinCon      = DestinatarioConocimiento::with('adscripcion')->where('iid_documento','=',$id_documento)->where('iestatus','=',1)->get();
        else
            $destinCon      = new DestinatarioConocimiento();
//Y convertirla en un arreglo
        $array3 = array();
        if($destinCon_total>0){
            foreach($destinCon as $destCon) {
                if ($destCon->iid_adscripcion==1355) {
                    $array3[]   = $destCon->iid_otra_adscripcion;
                    $array2[]   = $destCon->iid_otro_puesto;
                } else {
                    $array3[]   = $destCon->iid_adscripcion;
                }
            }
        }
    //Para poder usarla en la Consulta de Personal Destinatario Conocimiento
        $pers_destCon       = Personal::with('puesto','adscripcion')->whereIn('iid_adscripcion',$array3)
                                                                  //->whereIn('iid_personal',$array2)
                                                                    ->whereIn('iid_puesto',$array2)
                                                                    ->where('iestatus','=',1)->get();
        $data['pers_destCon']= $pers_destCon;

//Datos del Remitente
        $personaRemitente   = Personal::with('adscripcion','puesto')->where('iid_personal','=',$docto->iid_personal_remitente)->where('iestatus','=',1)->first();
        $data['personaRmte']= $personaRemitente;
        $parametros         = Parametros::where('ianio','=',$anio)->first();
        $data['documento']  = Documento::with('tipodocumento','tipoanexo','estatusdocumento','prioridaddocumento','importanciacontenido','tema','tipoasunto','instruccion','personalremitente','personalconocimiento','destinatarioatencion','destinatarioconocimiento')->where('iid_documento','=',$id_documento)->where('iestatus','=',1)->first();
        $data['parametros'] = $parametros;
        $nombreArchivo = 'acuse-'.$docto->cfolio.'_'.$fecha.'.pdf';

    //CÓDIGO PARA GENERAR UNA PAPELETA POR PERSONA ATENCIÓN
        for ($i=1; $i<=$destinAtt_total; $i++) {
            $data['i'] = $i;
            $htmlA[$i] = view('documentos.creaPDF.acusea',$data)->render();
        }
    //CÓDIGO PARA GENERAR UNA PAPELTA POR PERSONA CONOCIMIENTO
        for ($j=1; $j<=$destinCon_total; $j++) {
            $data['j'] = $j;
            $htmlB[$j] = view('documentos.creaPDF.acuseb',$data)->render();
        }
        $htmlC = view('documentos.creaPDF.acusec',$data)->render();
        $mpdf  = new Mpdf(['format' => 'letter'
                            ,'margin_top'=>20
                            ,'margin_bottom'=>20
                            ,'margin_left'=>20
                            ,'margin_right'=>20
                         ]);
        // Write some HTML code:
        $mpdf->SetDisplayMode('fullpage');
    //CÓDIGO PARA IMPRIMIR UNA PAPELETA POR PERSONA ATENCIÓN
        for ($i=1; $i<=$destinAtt_total; $i++) {
            $mpdf->writeHTML($htmlA[$i]); //imprimes la variable $html que contiene tu HTML
            $mpdf->AddPage();
        }
    //CÓDIGO PARA IMPRIMIR UNA PAPELETA POR PERSONA CONOCIMIENTO
        for ($j=1; $j<=$destinCon_total; $j++) {
            $mpdf->writeHTML($htmlB[$j]); //imprimes la variable $html que contiene tu HTML
            $mpdf->AddPage();
        }
        $mpdf->writeHTML($htmlC);
        $mpdf->Output($nombreArchivo,'D');//Salida del documento  D
    }

    public function editar_documento($id_documento)
    {
        $documento          = Documento::where('iid_documento','=',$id_documento)->first();
        $listTipoDocumento  = TipoDocumento::where('iestatus','=',1)->orderBy('cdescripcion_tipo_documento')->get();
        $listTipoAnexo      = TipoAnexo::where('iestatus','=',1)->get();
        $listEstatus        = EstatusDocumento::where('iestatus','=',1)->get();
        $listPrioridad      = PrioridadDocumento::where('iestatus','=',1)->get();
        $listSemaforo       = Semaforo::where('iestatus','=',1)->get();
    //Datos de Personal Remitente
        $remitente          = Personal::with('puesto','adscripcion')->where('iid_personal','=',$documento->iid_personal_remitente)->first();
                                                                    //->where('iestatus','=',1)->first();
        $listPersonal       = Personal::with('puesto','adscripcion')->where('iestatus','=',1)->get();
        $listPuesto         = Puesto::where('iestatus','=',1)->get();
        $listAdscripcion    = Adscripcion::where('iestatus','=',1)->get();
        $listTipoArea       = TipoArea::where('iestatus','=',1)->get();
        $listImportancia    = ImportanciaContenido::where('iestatus','=',1)->get();
        $listTema           = Tema::where('iestatus','=',1)->get();
        $listAsunto         = TipoAsunto::where('iestatus','=',1)->get();
        $listInstruccion    = Instruccion::where('iestatus','=',1)->get();
        $listDestinAtn      = Adscripcion::where('iid_tipo_area','=',4)->where('iestatus','=',1)->get();
        $listDestinConoc    = Adscripcion::where('iid_tipo_area','=',4)->where('iestatus','=',1)->get();
    //Datos de Personal Conocimiento
        $pers_conoc_total   = PersonalConocimiento::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->count();
        if($pers_conoc_total>0) {
        //Obtener la lista de Personal con Copia de Conocimiento
            $pers_conoc     = PersonalConocimiento::with('personal')->where('iid_documento','=',$id_documento)->where('iestatus','=',1)->get();
        } else {
            $pers_conoc     = new PersonalConocimiento();
        }
    //Datos de Destinatario Atención
        $destinAtt_total    = DestinatarioAtencion::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->count();
        $otro_pers_at       = null;
        if($destinAtt_total>0) {
            $destinAtt      = DestinatarioAtencion::with('otraadscripcion','otropuesto','otropersonal','tipodocumento','estatusdocumento')
                                                  ->where('iid_documento','=',$id_documento)->where('iestatus','=',1)->orderBy('iid_adscripcion')->get();
            if ($documento->iid_tipo_documento==8) {
                $otropers_at_total = DestinatarioAtencion::with('otraadscripcion','otropuesto','otropersonal')
                                                    ->where('iid_documento','=',$id_documento)
                                                    ->whereIn('iid_adscripcion',[231,1354])
                                                    ->where('iestatus','=',1)->count();
                if ($otropers_at_total>0) {
                    $otro_pers_at = DestinatarioAtencion::with('otraadscripcion','otropuesto','otropersonal')
                                                    ->where('iid_documento','=',$id_documento)
                                                    ->whereIn('iid_adscripcion',[231,1354])
                                                    ->where('iestatus','=',1)->first();
                } else {
                    $otro_pers_at = null;
                }
            } else {
                $otropers_at_total = DestinatarioAtencion::with('otraadscripcion','otropuesto','otropersonal')
                                                    ->where('iid_documento','=',$id_documento)
                                                    ->where('iid_adscripcion','=',1355)
                                                    ->where('iestatus','=',1)->count();
                if ($otropers_at_total>0) {
                    $otro_pers_at = DestinatarioAtencion::with('otraadscripcion','otropuesto','otropersonal')
                                                    ->where('iid_documento','=',$id_documento)
                                                    ->where('iid_adscripcion','=',1355)
                                                    ->where('iestatus','=',1)->first();
                } else {
                    $otro_pers_at = null;
                }
            }
        } else {
            $destinAtt      = new DestinatarioAtencion();
            $otro_pers_at   = null;
        }

    //Datos de Destinatario Conocimiento
        $destinCon_total    = DestinatarioConocimiento::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->count();
        $otro_pers_cn       = null;
        if($destinCon_total>0) {
            $destinCon      = DestinatarioConocimiento::with('otraadscripcion','otropuesto','otropersonal')
                                                  ->where('iid_documento','=',$id_documento)->where('iestatus','=',1)->orderBy('iid_adscripcion')->get();
            if ($documento->iid_tipo_documento==8) {
                $otropers_cn_total = DestinatarioConocimiento::with('otraadscripcion','otropuesto','otropersonal')
                                                        ->where('iid_documento','=',$id_documento)
                                                        ->whereIn('iid_adscripcion',[231,1354])
                                                        ->where('iestatus','=',1)->count();
                if ($otropers_cn_total>0) {
                    $otro_pers_cn = DestinatarioConocimiento::with('otraadscripcion','otropuesto','otropersonal')
                                                        ->where('iid_documento','=',$id_documento)
                                                        ->whereIn('iid_adscripcion',[231,1354])
                                                        ->where('iestatus','=',1)->first();
                } else {
                    $otro_pers_cn = null;
                }
            } else {
                $otropers_cn_total = DestinatarioConocimiento::with('otraadscripcion','otropuesto','otropersonal')
                                                        ->where('iid_documento','=',$id_documento)
                                                        ->where('iid_adscripcion','=',1355)
                                                        ->where('iestatus','=',1)->count();
                if ($otropers_cn_total>0) {
                    $otro_pers_cn = DestinatarioConocimiento::with('otraadscripcion','otropuesto','otropersonal')
                                                        ->where('iid_documento','=',$id_documento)
                                                        ->where('iid_adscripcion','=',1355)
                                                        ->where('iestatus','=',1)->first();
                } else {
                    $otro_pers_cn = null;
                }
            }
        } else {
            $destinCon      = new DestinatarioConocimiento();
            $otro_pers_cn   = null;
        }

    //Folio(s) Relacionado(s)
        $folsRels_total     = FolioRelacionado::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->count();
        if ($folsRels_total>0){
        //Obtener la lista de Folios Relacionados
            $listafolsRels  = FolioRelacionado::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->get();
        //Y convertirla en un arreglo
            $array1 = array();
            foreach($listafolsRels as $folrel)
                $array1[]   = $folrel->cfolio_relacionado;
        //Para poder usarla en la consulta de Folios Relacionados
            $docs_rels      = Documento::whereIn('cfolio',$array1)->where('iestatus','=',1)->get();
        } else {
            $listafolsRels  = new FolioRelacionado();
            $docs_rels      = new Documento();
        }
    //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar           = '';
    //Auxiliar para que pinte Checkboxes, si nuevo_registro=1, entonces van sin checkear
        $nuevo_registro     = '0';
        return view('documentos.editar',compact('documento','listTipoDocumento','listTipoAnexo','listEstatus','listPrioridad','listSemaforo','remitente','listPersonal','listPuesto','listAdscripcion','listTipoArea','listImportancia','listTema','listAsunto','listInstruccion','listDestinAtn','listDestinConoc','pers_conoc_total','pers_conoc','destinAtt','destinAtt_total','otro_pers_at','destinCon','destinCon_total','otro_pers_cn','folsRels_total','listafolsRels','docs_rels','noeditar','nuevo_registro'));
    }

    public function actualizar_documento(Request $request)
    {
        $documento                              = Documento::where('iid_documento','=',$request->id_documento)->first();
        $jsonBefore                             = "ACTUALIZA DOCUMENTO ".json_encode($documento);
        $idDocumento                            = $request->id_documento;
    //CAPTURA MANUAL DEL FOLIO, VALIDACIONES
        //Revisar que no exista un Documento con el mismo Folio.
        $ya_existe_folio                        = Documento::where('cfolio','=',$request->folio_documento)->where('iestatus','=',1)->count();
        //Si no hay, entonces agregar a Documentos con el Folio capturado.
        if ($ya_existe_folio==0) 
            $documento->cfolio                  = $request->folio_documento;
        else 
            $documento->cfolio                  = $request->folio_actual;
    //FIN DE VALIDACIONES DE LA CAPTURA MANUAL DEL FOLIO
        $documento->dfecha_recepcion            = $request->recepcion_documento;
        $documento->cnumero_documento           = $request->numero_documento;
        $documento->dfecha_documento            = $request->fecha_documento;
        $documento->iid_tipo_documento          = $request->tipo_documento;
        $documento->iid_tipo_anexo              = $request->tipo_anexo;
        $documento->cotro_tipo_anexo            = $request->otro_tipo_anexo;
        $documento->iid_personal_remitente      = $request->idRemitente;
        $documento->iid_estatus_documento       = $request->estatus_documento;
        $documento->iid_prioridad_documento     = $request->prioridad_documento;
        $documento->iid_semaforo                = $request->semaforo;
        $documento->cnomenclatura_archivistica  = $request->nomenclatura_archivistica;
        $documento->iid_importancia_contenido   = $request->importancia_contenido;
        $documento->iid_tema                    = $request->tema;
        $documento->iid_tipo_asunto             = $request->tipo_asunto;
        $documento->cotro_tipo_asunto           = $request->otro_tipo_asunto;
        $documento->iid_instruccion             = $request->instruccion;
        $documento->dfecha_termino              = $request->fecha_termino;
        $documento->casunto                     = $request->asunto;
        $documento->cobservaciones              = $request->observaciones;

        //Manejo del archivo PDF
        if($request->hasFile("archivo")){
            $file=$request->file("archivo");
            
            $nombre = "pdf_".time().".".$file->guessExtension();

            $ruta = public_path("pdf/".$nombre);

            if($file->guessExtension()=="pdf"){
                copy($file, $ruta);
                $documento->cruta_archivo_documento = $ruta;
            }else{
                $documento->cruta_archivo_documento = '';
                dd("NO ES UN PDF");
            }
        }
        //Fin de Manejo del archivo PDF
        
        $documento->iestatus                    = 1;
        $documento->iid_usuario                 = auth()->user()->id;
        $documento->save();
        $jsonAfter                              = json_encode($documento);
        DocumentosController::bitacora($jsonBefore,$jsonAfter);

        //Folios Relacionados
        if($request->folio_relacionado!="")
            FolioRelacionadoController::guarda_folio_relacionado($idDocumento, $request->folio_relacionado);

        //Destinatarios de Copia de Conocimiento
        if($request->nombre_destinatariocc>0)
            PersonalConocimientoController::guarda_personal_conoc($idDocumento, $request->idDestinatario);

        if ($request->tipo_documento<=6 || $request->tipo_documento>=9) {        
    //Actualizar Destinatarios para Atención
            /*
            if($request->atencion2==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1027', 1);    //OM
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1027', 0);
            */
            if($request->atencion12==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '229', 1);     //DEP
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '229', 0);
            if($request->atencion14==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '227', 1);     //DEGT
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '227', 0);
            if($request->atencion15==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '231', 1);     //DERH
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '231', 0);
            if($request->atencion16==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '228', 1);     //DEOMS
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '228', 0);
            if($request->atencion17==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '232', 1);     //DERM
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '232', 0);
            if($request->atencion18==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '230', 1);     //DERF
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '230', 0);
            if($request->atencion19==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1215', 1);    //DS
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1215', 0);
            if($request->atencion20==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1354', 1);    //DA CJPJCD
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1354', 0);
            if($request->atencion21==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1208', 1);    //DGJ
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1208', 0);
            if($request->atencion999==='on') {
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1355', 1);    //OTRA
    //Guardar OTRO Personal que ya Existe en el Catálogo
                if (($request->idOtroPersonal!="" && $request->idOtroPuesto!="" && $request->idOtraAdscrip!="") &&
                ($request->nuevo_nombre_ac=="" && $request->otro_paterno_ac=="" && $request->otra_desc_puesto_ac=="" && 
                $request->otra_desc_adsc_ac=="" && $request->nvo_tipo_adscripcion_ac==""))
                    DestinatarioAtencionController::actualiza_otra_persona($idDocumento,$request->idOtroPuesto,$request->idOtraAdscrip,$request->idOtroPersonal);

    //GUARDAR OTRO PERSONAL NUEVO, CON PUESTO NUEVO/YA EXISTE Y ADSCRIPCIÓN NUEVA/YA EXISTE
    //Guardar Nuevo Puesto
                if ($request->otra_desc_puesto_ac!="")
                    $idPuesto_ac = DocumentosController::busca_puesto($request->otra_desc_puesto_ac);
    //Guardar Nueva Adscripción
                if ($request->otra_desc_adsc_ac!="" && $request->nvo_tipo_adscripcion_ac!="")
                    $idAdscrip_ac= DocumentosController::busca_adscripcion($request->otra_desc_adsc_ac, $request->nvo_tipo_adscripcion_ac);
    //Guardar Nuevo Personal
                if ($request->nuevo_nombre_ac!="" && $request->otro_paterno_ac!=""){
        //Revisar que no exista una persona con el mismo Nombre y Apellidos
                    $ya_hay_pers                                     = Personal::where('cnombre_personal','=',$request->nuevo_nombre_ac)
                                                                           ->where('cpaterno_personal','=',$request->otro_paterno_ac)
                                                                           ->where('cmaterno_personal','=',$request->otro_materno_ac)
                                                                           ->where('iestatus','=',1)->count();
        //Si no hay, entonces agregar al catálogo
                    if ($ya_hay_pers==0) {
                        $nuevo_personal                              = new Personal();
                        $jsonBeforeNvoPersonal                       = "NEW INSERT PERSONAL";
                        $nuevo_personal->cnombre_personal            = $request->nuevo_nombre_ac;
                        $nuevo_personal->cpaterno_personal           = $request->otro_paterno_ac;
                        $nuevo_personal->cmaterno_personal           = $request->otro_materno_ac;
                //GUARDAR CLAVE DE PUESTO
                        if($request->otra_desc_puesto_ac!="")
                            $nuevo_personal->iid_puesto              = $idPuesto_ac;                        //ID PUESTO NUEVO/EXISTENTE EN BD
                        elseif ($request->otro_nvo_puesto_ac!="")
                            $nuevo_personal->iid_puesto              = $request->otro_nvo_puesto_ac;        //ID PUESTO EXISTENTE DE LA LISTA
                //GUARDAR CLAVE DE ADSCRIPCION
                        if ($request->otra_desc_adsc_ac!="")
                            $nuevo_personal->iid_adscripcion         = $idAdscrip_ac;                       //ID ADSCRIP. NUEVA/EXISTENTE EN BD
                        elseif ($request->otra_nva_adscripcion_ac!="")
                            $nuevo_personal->iid_adscripcion         = $request->otra_nva_adscripcion_ac;   //ID ADSCRIP. EXISTENTE DE LA LISTA
                        $nuevo_personal->iestatus                    = 1;
                        $nuevo_personal->iid_usuario                 = auth()->user()->id;
                        $nuevo_personal->save();
                        $jsonAfterNvoPersonal                        = json_encode($nuevo_personal);
                        PersonalController::bitacora($jsonBeforeNvoPersonal,$jsonAfterNvoPersonal);
                        DestinatarioAtencionController::actualiza_otra_persona($idDocumento,$nuevo_personal->iid_puesto,$nuevo_personal->iid_adscripcion,$nuevo_personal->iid_personal);
                    }
                }
            } else 
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1355', 0);
        }
        if($request->tipo_documento==8) {
            if($request->atencion_presidente==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1031', 1);    //PRESIDENCIA
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1031', 0);
            if($request->atencion_oficialmayor==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1027', 1);    //OM
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1027', 0);
            if($request->atencion_da==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1354', 1);  //DA
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1354', 0);
            if($request->atencion_derh==='on')
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '231', 1);  //DERH
            else
                DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '231', 0);
        }
        if ($request->tipo_documento<=6 || $request->tipo_documento>=9) {
            //Actualizar Destinatarios para Conocimiento
            /*
            if($request->conoc2==='on')
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1027', 1);   //OM
            else
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1027', 0);
            */
            if($request->conoc12==='on')
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '229', 1);    //DEP
            else
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '229', 0);
            if($request->conoc14==='on')
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '227', 1);    //DEGT
            else
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '227', 0);
            if($request->conoc15==='on')
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '231', 1);    //DERH
            else
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '231', 0);
            if($request->conoc16==='on')
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '228', 1);    //DEOMS
            else
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '228', 0);
            if($request->conoc17==='on')
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '232', 1);    //DERM
            else
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '232', 0);
            if($request->conoc18==='on')
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '230', 1);    //DERF
            else
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '230', 0);
            if($request->conoc19==='on')
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1215', 1);   //DS
            else
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1215', 0);
            if($request->conoc20==='on')
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1354', 1);   //DA CJPJCD
            else
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1354', 0);
            if($request->conoc21==='on')
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1208', 1);   //DGJ
            else
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1208', 0);
            if($request->conoc999==='on') {
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1355', 1);   //OTRA
    //Guardar OTRO Personal que ya Existe en el Catálogo
                if (($request->idOtroPersonal!="" && $request->idOtroPuesto!="" && $request->idOtraAdscrip!="") &&
                ($request->nuevo_nombre_ac=="" && $request->otro_paterno_ac=="" && $request->otra_desc_puesto_ac=="" && 
                $request->otra_desc_adsc_ac=="" && $request->nvo_tipo_adscripcion_ac==""))
                    DestinatarioConocimientoController::actualiza_otra_persona($idDocumento,$request->idOtroPuesto,$request->idOtraAdscrip,$request->idOtroPersonal);
            
    //Guardar Nuevo Puesto
                if ($request->otra_desc_puesto_ac!="")
                    $idPuesto_ac = DocumentosController::busca_puesto($request->otra_desc_puesto_ac);
    //Guardar Nueva Adscripción
                if ($request->otra_desc_adsc_ac!="" && $request->nvo_tipo_adscripcion_ac!="")
                    $idAdscrip_ac= DocumentosController::busca_adscripcion($request->otra_desc_adsc_ac, $request->nvo_tipo_adscripcion_ac);
    //Guardar Nuevo Personal
                if ($request->nuevo_nombre_ac!="" && $request->otro_paterno_ac!=""){
        //Revisar que no exista una persona con el mismo Nombre y Apellidos
                    $ya_hay_pers                                     = Personal::where('cnombre_personal','=',$request->nuevo_nombre_ac)
                                                                           ->where('cpaterno_personal','=',$request->otro_paterno_ac)
                                                                           ->where('cmaterno_personal','=',$request->otro_materno_ac)
                                                                           ->where('iestatus','=',1)->count();
        //Si no hay, entonces agregar al catálogo
                    if ($ya_hay_pers==0) {
                        $nuevo_personal                              = new Personal();
                        $jsonBeforeNvoPersonal                       = "NEW INSERT PERSONAL";
                        $nuevo_personal->cnombre_personal            = $request->nuevo_nombre_ac;
                        $nuevo_personal->cpaterno_personal           = $request->otro_paterno_ac;
                        $nuevo_personal->cmaterno_personal           = $request->otro_materno_ac;
                    //GUARDAR CLAVE DE PUESTO
                        if($request->otra_desc_puesto_ac!="")
                            $nuevo_personal->iid_puesto              = $idPuesto_ac;                        //ID PUESTO NUEVO/EXISTENTE EN BD
                        elseif ($request->otro_nvo_puesto_ac!="")
                            $nuevo_personal->iid_puesto              = $request->otro_nvo_puesto_ac;        //ID PUESTO EXISTENTE DE LA LISTA
                    //GUARDAR CLAVE DE ADSCRIPCION
                        if ($request->otra_desc_adsc_ac!="")
                            $nuevo_personal->iid_adscripcion         = $idAdscrip_ac;                       //ID ADSCRIP. NUEVA/EXISTENTE EN BD
                        elseif ($request->otra_nva_adscripcion_ac!="")
                            $nuevo_personal->iid_adscripcion         = $request->otra_nva_adscripcion_ac;   //ID ADSCRIP. EXISTENTE DE LA LISTA
                        $nuevo_personal->iestatus                    = 1;
                        $nuevo_personal->iid_usuario                 = auth()->user()->id;
                        $nuevo_personal->save();
                        $jsonAfterNvoPersonal                        = json_encode($nuevo_personal);
                        PersonalController::bitacora($jsonBeforeNvoPersonal,$jsonAfterNvoPersonal);
                        DestinatarioConocimientoController::actualiza_otra_persona($idDocumento,$nuevo_personal->iid_puesto,$nuevo_personal->iid_adscripcion,$nuevo_personal->iid_personal);
                    }
                }
            } else
                DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1355', 0);
        }

        //return redirect()->route('documentos.index')
                         //->with('success','Documento actualizado satisfactoriamente');
        return redirect()->route('documentos.editar',$idDocumento)
                         ->with('success','Documento actualizado satisfactoriamente');
    }

    public function confirmainhabilitar_documento($id_documento)
    {
        $documento          = Documento::where('iid_documento','=',$id_documento)->first();
        $listTipoDocumento  = TipoDocumento::where('iestatus','=',1)->get();
        $listTipoAnexo      = TipoAnexo::where('iestatus','=',1)->get();
        $listEstatus        = EstatusDocumento::where('iestatus','=',1)->get();
        $listPrioridad      = PrioridadDocumento::where('iestatus','=',1)->get();
        $listSemaforo       = Semaforo::where('iestatus','=',1)->get();
        $listPersonal       = Personal::where('iestatus','=',1)->get();
        $remitente          = Personal::where('iid_personal','=',$documento->iid_personal_remitente)->where('iestatus','=',1)->first();
        $listPuesto         = Puesto::where('iestatus','=',1)->get();
        $puesto             = Puesto::where('iid_puesto','=',$remitente->iid_puesto)->where('iestatus','=',1)->first();
        $listAdscripcion    = Adscripcion::where('iestatus','=',1)->get();
        $adscripcion        = Adscripcion::where('iid_adscripcion','=',$remitente->iid_adscripcion)->where('iestatus','=',1)->first();
        $listImportancia    = ImportanciaContenido::where('iestatus','=',1)->get();
        $listTema           = Tema::where('iestatus','=',1)->get();
        $listAsunto         = TipoAsunto::where('iestatus','=',1)->get();
        $listInstruccion    = Instruccion::where('iestatus','=',1)->get();
        $listDestinAtn      = Adscripcion::where('iid_tipo_area','=',4)->where('iestatus','=',1)->get();
        $listDestinConoc    = Adscripcion::where('iid_tipo_area','=',4)->where('iestatus','=',1)->get();
    //Datos de Personal Remitente
        $id_pers_remitente  = $documento->iid_personal_remitente;
        $pers_remitente     = Personal::where('iid_personal','=',$id_pers_remitente)->first();
    //Datos de Personal Conocimiento
        $pers_conoc_total   = PersonalConocimiento::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->count();
        if($pers_conoc_total>0) {
            $pers_conoc     = PersonalConocimiento::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->first();
            $pers_cncmnt    = Personal::where('iid_personal','=',$pers_conoc->iid_personal)->where('iestatus','=',1)->first();
        } else {
            $pers_conoc     = new PersonalConocimiento();
            $pers_cncmnt    = new Personal();
        }
    //Datos de Destinatario Atención
        $destinAtt_total    = DestinatarioAtencion::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->count();
        if($destinAtt_total>0)
            $destinAtt      = DestinatarioAtencion::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->get();
        else
            $destinAtt      = new DestinatarioAtencion();
    //Datos de Destinatario Conocimiento
        $destinCon_total    = DestinatarioConocimiento::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->count();
        if($destinCon_total>0)
            $destinCon      = DestinatarioConocimiento::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->get();
        else
            $destinCon      = new DestinatarioConocimiento();
    //Folio(s) Relacionado(s)
        $folsRels_total     = FolioRelacionado::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->count();
        if ($folsRels_total>0){
        //Obtener la lista de Folios Relacionados
            $listafolsRels  = DB::table('tafolios_relacionados')
                                ->select('cfolio_relacionado')
                                ->where('iid_documento','=',$id_documento)
                                ->where('iestatus','=',1)
                                ->orderBy('cfolio_relacionado')->get();
        //Y convertirla en un arreglo
            $array1 = array();
            foreach($listafolsRels as $folrel)
                $array1[]   = $folrel->cfolio_relacionado;
        //Para poder usarla en la consulta de Folios Relacionados
            $docs_rels      = Documento::whereIn('cfolio',$array1)->where('iestatus','=',1)->get();
        } else {
            $listafolsRels  = new FolioRelacionado();
            $docs_rels      = new Documento();
        }
    //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar           = 'disabled';
    //Auxiliar para que pinte Checkboxes, si nuevo_registro=1, entonces van sin checkear
        $nuevo_registro     = '0';
        return view('documentos.inhabilitar',compact('documento','listTipoDocumento','listTipoAnexo','listEstatus','listPrioridad','listSemaforo','listPersonal','remitente','listPuesto','puesto','listAdscripcion','adscripcion','listImportancia','listTema','listAsunto','listInstruccion','listDestinAtn','listDestinConoc','pers_remitente','pers_conoc','pers_cncmnt','destinAtt','destinAtt_total','destinCon','destinCon_total','folsRels_total','docs_rels','noeditar','nuevo_registro'));
    }

    public function inhabilitar_documento(Request $request) 
    {
        $documento               = Documento::where('iid_documento','=',$request->id_documento)->first();
        if ($documento->iestatus == 0) {
            $operacion           = "RECUPERADO";
            $documento->iestatus = 1;
        } else {
            $operacion           = "BORRADO";
            $documento->iestatus = 0;
        }
        $jsonBefore              = "DOCUMENTO ".$operacion." ".json_encode($documento);
        $documento->iid_usuario  = auth()->user()->id;
        $documento->save();
        $jsonAfter               = json_encode($documento);
        DocumentosController::bitacora($jsonBefore,$jsonAfter);

        return redirect()->route('documentos.index',$request->id_documento)
                         ->with('success','Documento '.$operacion.' satisfactoriamente');
    }

//Completar folios a 5 dígitos con ceros a la izquierda
    public function completarFolios(){
        $documentos     = Documento::where('iestatus','=',1)->get();     //Procesar todos
        $numregs   = Documento::where('iestatus','=',1)->count();   //Contarlos
        foreach($documentos as $docs){
            $nf = explode('-',$docs->cfolio);
            $fc = str_pad($nf[0],5,'0',STR_PAD_LEFT).'-'.$nf[1];
            $docs->cfolio = $fc;
            $docs->save();
        }
        $data['documentos'] = Documento::with('tipodocumento','tipoanexo','estatusdocumento','prioridaddocumento','semaforodocumento','importanciacontenido','tema','tipoasunto','instruccion','personalremitente','personalconocimiento','destinatarioatencion','destinatarioconocimiento')->where('iestatus','=',1)->orderBy('iid_semaforo')->get();
        return view('documentos.index',$data);
    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }

//Busca Número de Documento Duplicado
    public function buscaDoctoDuplicado(Request $request){
        $nd            = $request->nd;
        $coincidencias = Documento::where('cnumero_documento','=',$nd)->where('iestatus','=',1)->get();
        if (!$coincidencias->isEmpty()){
            $folio     = $coincidencias[0]->cfolio;
            return response()->json(
                [
                    'nd'    => $nd,
                    'folio' => $folio,
                    'exito' => 1
                ]
            );
        }else{
            return response()->json(
                [
                    'nd'    => null,
                    'folio' => null,
                    'exito' => 0
                ]
            );
        }
    }

//Busca Número de Folio Duplicado
    public function buscaFolioDuplicado(Request $request){
        $fd            = $request->fd;
        $coincidencias = Documento::where('cfolio','=',$fd)->where('iestatus','=',1)->get();
        if (!$coincidencias->isEmpty()){
            $folio     = $coincidencias[0]->cfolio;
            return response()->json(
                [
                    'fd'    => $folio,
                    'exito' => 1
                ]
            );
        }else{
            return response()->json(
                [
                    'fd'    => null,
                    'exito' => 0
                ]
            );
        }
    }

//Busca Puesto
    public static function busca_puesto(string $otra_descrip) {
    //Guardar Nuevo Puesto
    //Revisar que no exista un puesto con la misma Descripción
        $ya_hay_puesto                                   = Puesto::where('cdescripcion_puesto','=',$otra_descrip)
                                                                 ->where('iestatus','=',1)->count();
    //Si no hay, entonces agregar al catálogo
        if ($ya_hay_puesto==0) {
            $nuevo_puesto                                = new Puesto();
            $jsonBeforeNvoPuesto                         = "NEW INSERT PUESTO";
            $nuevo_puesto->cdescripcion_puesto           = $otra_descrip;
            $nuevo_puesto->iestatus                      = 1;
            $nuevo_puesto->iid_usuario                   = auth()->user()->id;
            $nuevo_puesto->save();
            $jsonAfterNvoPuesto                          = json_encode($nuevo_puesto);
            PuestosController::bitacora($jsonBeforeNvoPuesto,$jsonAfterNvoPuesto);
            return $nuevo_puesto->iid_puesto;
        } else {
            $puesto_existente                            = Puesto::where('cdescripcion_puesto','=',$otra_descrip)
                                                                 ->where('iestatus','=',1)->first();
            return $puesto_existente->iid_puesto;
        }
    }

    public static function busca_adscripcion(string $otra_descrip, string $tipo_adscrip){
    //Guardar Nueva Adscripción
    //Revisar que no exista una adscripción con la misma Descripción
        $ya_hay_adsc                                     = Adscripcion::where('cdescripcion_adscripcion','=',$otra_descrip)
                                                                      ->where('iestatus','=',1)->count();
    //Si no hay, entonces agregar al catálogo
        if ($ya_hay_adsc==0) {
            $nueva_adscripcion                           = new Adscripcion();
            $jsonBeforeOtraAdscrip                       = "NEW INSERT ADSCRIPCION";
            $nueva_adscripcion->cdescripcion_adscripcion = $otra_descrip;
            $nueva_adscripcion->iid_tipo_area            = $tipo_adscrip;
            $nueva_adscripcion->iestatus                 = 1;
            $nueva_adscripcion->iid_usuario              = auth()->user()->id;
            $nueva_adscripcion->save();
            $jsonAfterOtraAdscrip                        = json_encode($nueva_adscripcion);
            AdscripcionesController::bitacora($jsonBeforeOtraAdscrip,$jsonAfterOtraAdscrip);
            return $nueva_adscripcion->iid_adscripcion;
        } else {
            $adscripcion_existente                       = Adscripcion::where('cdescripcion_adscripcion','=',$otra_descrip)
                                                                      ->where('iestatus','=',1)->first();
            return $adscripcion_existente->iid_adscripcion;
        }
    }

    public function export(){
        return Excel::download(new DocumentosExport, 'Documentos.xlsx');
    }
}
