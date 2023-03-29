<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Catalogos\PersonalController;
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

class DocumentosController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

    public function index(Request $request)
    {
        $folio = $request->folio;
        if ($folio != "") {
            $data['documentos'] = Documento::with('tipodocumento','tipoanexo','estatusdocumento','prioridaddocumento','importanciacontenido','tema','tipoasunto','instruccion','personalremitente','personalconocimiento','destinatarioatencion','destinatarioconocimiento')->where('cfolio','=',$folio)->where('iestatus','=',1)->get();
        } else {
            $data['documentos'] = Documento::with('tipodocumento','tipoanexo','estatusdocumento','prioridaddocumento','importanciacontenido','tema','tipoasunto','instruccion','personalremitente','personalconocimiento','destinatarioatencion','destinatarioconocimiento')->where('iestatus','=',1)->get();
        }
        return view('documentos.index',$data);
    }

    public function nuevo_documento()
    {
        $documento         = new Documento();
        $anio              = Date('Y');
        $parametros        = Parametros::where('ianio','=',$anio)->first();
        $listTipoDocumento = TipoDocumento::where('iestatus','=',1)->get();
        $listTipoAnexo     = TipoAnexo::where('iestatus','=',1)->get();
        $listEstatus       = EstatusDocumento::where('iestatus','=',1)->get();
        $listPrioridad     = PrioridadDocumento::where('iestatus','=',1)->get();
        $listPersonal      = Personal::where('iestatus','=',1)->get();
        $listPuesto        = Puesto::where('iestatus','=',1)->get();
        $listAdscripcion   = Adscripcion::where('iestatus','=',1)->get();
        $listImportancia   = ImportanciaContenido::where('iestatus','=',1)->get();
        $listTema          = Tema::where('iestatus','=',1)->get();
        $listAsunto        = TipoAsunto::where('iestatus','=',1)->get();
        $listInstruccion   = Instruccion::where('iestatus','=',1)->get();
        $listDestinAtn     = Adscripcion::where('iid_tipo_area','=',4)->where('iestatus','=',1)->get();
        $listDestinConoc   = Adscripcion::where('iid_tipo_area','=',4)->where('iestatus','=',1)->get();
        $newfolio          = $parametros->iultimo_folio + 1;
        $newfolio          = $newfolio.'-'.substr($anio,2,2);
        $newfolio_rh       = $parametros->iultimo_folio_rh + 1;
        $newfolio_rh       = $newfolio_rh.'-'.substr($anio,2,2).'RH';
        $newfolio_cc       = $parametros->iultimo_folio_cc + 1;
        $newfolio_cc       = $newfolio_cc.'-'.substr($anio,2,2).'CC';
        $destinAtt         = new DestinatarioAtencion();
        $destinCon         = new DestinatarioConocimiento();
        $folioRel          = new FolioRelacionado();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar          = '';
        //Auxiliar para que pinte Checkboxes, si nuevo_registro=1, entonces van sin checkear
        $nuevo_registro     = '1';
        return view('documentos.nuevo',compact('documento','listTipoDocumento','listTipoAnexo','listEstatus','listPrioridad','listPersonal','listPuesto','listAdscripcion','listImportancia','listTema','listAsunto','listInstruccion','listDestinAtn','listDestinConoc','parametros','newfolio','newfolio_rh','newfolio_cc','destinAtt','destinCon','folioRel','noeditar','nuevo_registro'));
    }

    public function guardar_documento(Request $request)
    {
        $now  = new \DateTime();
        $anio = Date('Y');
        $documento                              = new Documento();
        $parametros                             = Parametros::where('ianio','=',$anio)->first();
        if($request->tipo_documento<=6) {
            $newfolio                               = $parametros->iultimo_folio + 1;
            $newfolio                               = $newfolio.'-'.substr($parametros->ianio,2,2);
        } elseif($request->tipo_documento==7) {
            $newfolio_cc                            = $parametros->iultimo_folio_cc + 1;
            $newfolio_cc                            = $newfolio_cc.'-'.substr($parametros->ianio,2,2).'CC';
        } elseif($request->tipo_documento==8) {
            $newfolio_rh                            = $parametros->iultimo_folio_rh + 1;
            $newfolio_rh                            = $newfolio_rh.'-'.substr($parametros->ianio,2,2).'RH';
        }
        $jsonBefore                             = "NEW INSERT DOCUMENTO";
        if($request->tipo_documento<=6) 
            $documento->cfolio                  = $newfolio;
        elseif($request->tipo_documento==7)
            $documento->cfolio                  = $newfolio_cc;
        elseif($request->tipo_documento==8)
            $documento->cfolio                  = $newfolio_rh;
        $documento->dfecha_recepcion            = $request->recepcion_documento;
        $documento->cnumero_documento           = $request->numero_documento;
        $documento->dfecha_documento            = $request->fecha_documento;
        $documento->iid_tipo_documento          = $request->tipo_documento;
        $documento->iid_tipo_anexo              = $request->tipo_anexo;
        $documento->iid_personal_remitente      = $request->idRemitente;
        $documento->iid_estatus_documento       = $request->estatus_documento;
        $documento->iid_prioridad_documento     = $request->prioridad_documento;
        $documento->cnomenclatura_archivistica  = $request->nomenclatura_archivistica;
        $documento->iid_importancia_contenido   = $request->importancia_contenido;
        $documento->iid_tema                    = $request->tema;
        $documento->iid_tipo_asunto             = $request->tipo_asunto;
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
        //Obtener el último registro guardado en Documentos
        $idDocumento                            = $documento->iid_documento;
        $jsonAfter                              = json_encode($documento);
        DocumentosController::bitacora($jsonBefore,$jsonAfter);

        if($request->tipo_documento<=6) 
            $parametros->iultimo_folio          = $parametros->iultimo_folio + 1;
        elseif($request->tipo_documento==7)
            $parametros->iultimo_folio_cc       = $parametros->iultimo_folio_cc + 1;
        elseif($request->tipo_documento==8)
            $parametros->iultimo_folio_rh       = $parametros->iultimo_folio_rh + 1;
        $parametros->save();

        //Folios Relacionados
        if($request->folio_relacionado!="")
            FolioRelacionadoController::guarda_folio_relacionado($idDocumento, $request->folio_relacionado);

        //Destinatarios de Copia de Conocimiento
        if($request->nombre_destinatariocc>0)
            PersonalConocimientoController::guarda_personal_conoc($idDocumento, $request->idDestinatario);

        //Guardar Destinatarios para Atención
        if($request->atencion2==='on')
            DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '1027');  //OM
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
        if($request->atencion999==='on')
            DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '1355');  //OTRA
        if($request->atencion_presidente==='on')
            DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '1031');  //PRESIDENCIA
        if($request->atencion_oficialmayor==='on')
            DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '1027');  //OM

        //Guardar Destinatarios para Conocimiento
        if($request->conoc2==='on')
            DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '1027');  //OM
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
        if($request->conoc999==='on')
            DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '1355');  //OTRA

        return redirect()->route('documentos.index')
                         ->with('success','Documento guardado satisfactoriamente');
    }

    public function acuse_documento($id_documento)
    {
        setlocale(LC_TIME, "spanish");  //FECHA EN ESPANIOL
        $fecha              = date('Y-m-d');
        $anio               = date('Y');
        $docto              = Documento::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->first();
//Datos de Destinatario Atención
        $destinAtt_total    = DestinatarioAtencion::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->count();
        if($destinAtt_total>0)
            $destinAtt      = DestinatarioAtencion::with('adscripcion')->where('iid_documento','=',$id_documento)->where('iestatus','=',1)->get();
        else
            $destinAtt      = new DestinatarioAtencion();
//Y convertirla en un arreglo
        $array1 = array();
        foreach($destinAtt as $destAten)
            $array1[]       = $destAten->iid_adscripcion;
    //Arreglo auxiliar, para solamente traer los Directores Ejecutivos (1384 DEP,1718 DEGT,1771 DEOMS,1772 DERM,1775 DERF,1822 DERH), 
    //el Oficial Mayor 213, el Dir. de Seguridad 1860, el Presidente 62 del TSJ, y el de la Dir. Administrativa del CJ 1859
        $array2             = [62,213,1384,1718,1771,1772,1775,1822,1859,1860];
    //Para poder usarla en la consulta de Personal Destinatario Atención
        $pers_destAt        = Personal::with('puesto','adscripcion')->whereIn('iid_adscripcion',$array1)
                                                                    ->whereIn('iid_personal',$array2)
                                                                    ->where('iestatus','=',1)->get();
        $data['pers_destAt']= $pers_destAt;

        $nombreDestA        = Personal::with('puesto')->where('iid_adscripcion','=',$destinAtt[0]->iid_adscripcion)
                                                      ->whereIn('iid_personal',$array2)->where('iestatus','=',1)->first();
        $data['nombreDestA']= $nombreDestA;
        $personaRemitente   = Personal::with('adscripcion','puesto')->where('iid_personal','=',$docto->iid_personal_remitente)->where('iestatus','=',1)->first();
        $data['personaRmte']= $personaRemitente;
        $parametros         = Parametros::where('ianio','=',$anio)->first();
        $data['documento']  = Documento::with('tipodocumento','tipoanexo','estatusdocumento','prioridaddocumento','importanciacontenido','tema','tipoasunto','instruccion','personalremitente','personalconocimiento','destinatarioatencion','destinatarioconocimiento')->where('iid_documento','=',$id_documento)->where('iestatus','=',1)->first();
        $data['parametros'] = $parametros;
        $data['asignada']   = DestinatarioAtencion::with('documento','adscripcion')
                                                  ->where('iid_documento','=',$id_documento)->where('iestatus','=',1)->first();
        $nombreArchivo = 'acuse-'.$docto->cfolio.'_'.$fecha.'.pdf';

        $html  = view('documentos.creaPDF.acuse',$data)->render();
        $htmlB = view('documentos.creaPDF.acuseb',$data)->render();

        $mpdf  = new Mpdf(['format' => 'letter'
                            ,'margin_top'=>20
                            ,'margin_bottom'=>20
                            ,'margin_left'=>20
                            ,'margin_right'=>20
                         ]);
        // Write some HTML code:
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->writeHTML($html); //imprimes la variable $html que contiene tu HTML
        $mpdf->AddPage();
        $mpdf->writeHTML($htmlB);
        $mpdf->Output($nombreArchivo,'D');//Salida del documento  D
    }

    public function editar_documento($id_documento)
    {
        $documento          = Documento::where('iid_documento','=',$id_documento)->first();
        $listTipoDocumento  = TipoDocumento::where('iestatus','=',1)->get();
        $listTipoAnexo      = TipoAnexo::where('iestatus','=',1)->get();
        $listEstatus        = EstatusDocumento::where('iestatus','=',1)->get();
        $listPrioridad      = PrioridadDocumento::where('iestatus','=',1)->get();
    //Datos de Personal Remitente
        $remitente          = Personal::with('puesto','adscripcion')->where('iid_personal','=',$documento->iid_personal_remitente)
                                                                    ->where('iestatus','=',1)->first();
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
        if($destinAtt_total>0)
            $destinAtt      = DestinatarioAtencion::with('otraadscripcion','otropuesto','otropersonal')
                                                  ->where('iid_documento','=',$id_documento)->where('iestatus','=',1)->orderBy('iid_adscripcion')->get();
        else
            $destinAtt      = new DestinatarioAtencion();
    //Datos de Destinatario Conocimiento
        $destinCon_total    = DestinatarioConocimiento::where('iid_documento','=',$id_documento)->where('iestatus','=',1)->count();
        if($destinCon_total>0)
            $destinCon      = DestinatarioConocimiento::with('otraadscripcion','otropuesto','otropersonal')
                                                  ->where('iid_documento','=',$id_documento)->where('iestatus','=',1)->orderBy('iid_adscripcion')->get();
        else
            $destinCon      = new DestinatarioConocimiento();
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
        return view('documentos.editar',compact('documento','listTipoDocumento','listTipoAnexo','listEstatus','listPrioridad','remitente','listPersonal','listPuesto','listAdscripcion','listTipoArea','listImportancia','listTema','listAsunto','listInstruccion','listDestinAtn','listDestinConoc','pers_conoc_total','pers_conoc','destinAtt','destinAtt_total','destinCon','destinCon_total','folsRels_total','listafolsRels','docs_rels','noeditar','nuevo_registro'));
    }

    public function actualizar_documento(Request $request)
    {
        $documento                              = Documento::where('iid_documento','=',$request->id_documento)->first();
        $jsonBefore                             = json_encode($documento);
        $idDocumento                            = $request->id_documento;
        $documento->dfecha_recepcion            = $request->recepcion_documento;
        $documento->cnumero_documento           = $request->numero_documento;
        $documento->dfecha_documento            = $request->fecha_documento;
        $documento->iid_tipo_documento          = $request->tipo_documento;
        $documento->iid_tipo_anexo              = $request->tipo_anexo;
        $documento->iid_personal_remitente      = $request->idRemitente;
        $documento->iid_estatus_documento       = $request->estatus_documento;
        $documento->iid_prioridad_documento     = $request->prioridad_documento;
        $documento->cnomenclatura_archivistica  = $request->nomenclatura_archivistica;
        $documento->iid_importancia_contenido   = $request->importancia_contenido;
        $documento->iid_tema                    = $request->tema;
        $documento->iid_tipo_asunto             = $request->tipo_asunto;
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
        $totPersAnt                             = PersonalConocimiento::where('iid_documento','=',$idDocumento)->where('iestatus','=',1)->count();
        if($totPersAnt>0){
            $PersonalAnt                        = PersonalConocimiento::where('iid_documento','=',$idDocumento)->where('iestatus','=',1)->first();
            $idPersonalAnt                      = $PersonalAnt->iid_personal;
        } else {
            $idPersonalAnt                      = 0;
        }
        
        //Actualizar Destinatarios para Atención
        if($request->atencion2==='on')
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1027', 1);    //OM
        else
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1027', 0);
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
        if($request->atencion999==='on')
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1355', 1);    //OTRA
        else
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1355', 0);
        if($request->atencion_presidente==='on')
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1031', 1);    //PRESIDENCIA
        else
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1031', 0);
        if($request->atencion_oficialmayor==='on')
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1027', 1);    //OM
        else
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '1027', 0);

        //Actualizar Destinatarios para Conocimiento
        if($request->conoc2==='on')
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1027', 1);   //OM
        else
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1027', 0);
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
        if($request->conoc999==='on')
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1355', 1);   //OTRA
        else
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '1355', 0);

        return redirect()->route('documentos.index')
                         ->with('success','Documento actualizado satisfactoriamente');
    }

    public function confirmainhabilitar_documento($id_documento)
    {
        $documento          = Documento::where('iid_documento','=',$id_documento)->first();
        $listTipoDocumento  = TipoDocumento::where('iestatus','=',1)->get();
        $listTipoAnexo      = TipoAnexo::where('iestatus','=',1)->get();
        $listEstatus        = EstatusDocumento::where('iestatus','=',1)->get();
        $listPrioridad      = PrioridadDocumento::where('iestatus','=',1)->get();
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
        return view('documentos.inhabilitar',compact('documento','listTipoDocumento','listTipoAnexo','listEstatus','listPrioridad','listPersonal','remitente','listPuesto','puesto','listAdscripcion','adscripcion','listImportancia','listTema','listAsunto','listInstruccion','listDestinAtn','listDestinConoc','pers_remitente','pers_conoc','pers_cncmnt','destinAtt','destinAtt_total','destinCon','destinCon_total','folsRels_total','docs_rels','noeditar','nuevo_registro'));
    }

    public function inhabilitar_documento(Request $request) 
    {
        $documento               = Documento::where('iid_documento','=',$request->id_documento)->first();
        $jsonBefore              = json_encode($documento);
        if ($documento->iestatus == 0) {
            $operacion               = "RECUPERADO";
            $documento->iestatus = 1;
        } else {
            $operacion               = "BORRADO";
            $documento->iestatus = 0;
        }
        $documento->iid_usuario  = auth()->user()->id;
        $documento->save();
        $jsonAfter               = json_encode($documento);
        DocumentosController::bitacora($jsonBefore,$jsonAfter);

        return redirect()->route('documentos.index',$request->id_documento)
                         ->with('success','Documento '.$operacion.' satisfactoriamente');
    }

    public function reporte_estadistico()
    {
        setlocale(LC_TIME, "spanish");  //FECHA EN ESPANIOL
        $fecha              = date('Y-m-d');
        $data['fecha']      = $fecha;
        $anio               = date('Y');
        $data['anio']       = $anio;
        $parametros         = Parametros::where('ianio','=',$anio)->first();
        $data['parametros'] = $parametros;
        $nombreArchivo = 'estadistico_'.$fecha.'.pdf';

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

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }

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
}
