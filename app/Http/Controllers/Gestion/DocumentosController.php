<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Catalogos\PersonalController;
use App\Http\Controllers\Gestion\PersonalConocimientoController;
use App\Http\Controllers\Gestion\DestinatarioAtencionController;
use App\Http\Controllers\Gestion\DestinatarioConocimientoController;

use App\Models\Gestion\Documento;
use App\Models\Catalogos\Puesto;
use App\Models\Catalogos\Adscripcion;
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
        $destinAtt         = new DestinatarioAtencion();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar          = '';
        //Auxiliar para que pinte Checkboxes, si nuevo_registro=1, entonces van sin checkear
        $nuevo_registro     = '1';
        return view('documentos.nuevo',compact('documento','listTipoDocumento','listTipoAnexo','listEstatus','listPrioridad','listPersonal','listPuesto','listAdscripcion','listImportancia','listTema','listAsunto','listInstruccion','listDestinAtn','listDestinConoc','parametros','newfolio','destinAtt','noeditar','nuevo_registro'));
    }

    public function guardar_documento(Request $request)
    {
        $now  = new \DateTime();
        $anio = Date('Y');
        $documento                              = new Documento();
        $parametros                             = Parametros::where('ianio','=',$anio)->first();
        $newfolio                               = $parametros->iultimo_folio + 1;
        $newfolio                               = $newfolio.'-'.substr($parametros->ianio,2,2);
        $jsonBefore                             = "NEW INSERT DOCUMENTO";
        $documento->cfolio                      = $newfolio;
        $documento->dfecha_recepcion            = $request->recepcion_documento;
        $documento->cnumero_documento           = $request->numero_documento;
        $documento->dfecha_documento            = $request->fecha_documento;
        $documento->iid_tipo_documento          = $request->tipo_documento;
        $documento->iid_tipo_anexo              = $request->tipo_anexo;
        $documento->iid_personal_remitente      = $request->idRemitente;
        $documento->iid_estatus_documento       = $request->estatus_documento;
        $documento->iid_prioridad_documento     = $request->prioridad_documento;
        $documento->cfolio_relacionado          = $request->folio_relacionado;
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

        $parametros->iultimo_folio              = $parametros->iultimo_folio + 1;
        $parametros->save();

        //Destinatarios de Copia de Conocimiento
        if($request->nombre_destinatariocc>0)
            PersonalConocimientoController::guarda_personal_conoc($idDocumento, $request->nombre_destinatariocc);

        //Guardar Destinatarios para Atención
        if($request->atencion2==='on')
            DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '2');
        if($request->atencion12==='on')
            DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '12');
        if($request->atencion14==='on')
            DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '14');
        if($request->atencion15==='on')
            DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '15');
        if($request->atencion16==='on')
            DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '16');
        if($request->atencion17==='on')
            DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '17');
        if($request->atencion18==='on')
            DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '18');
        if($request->atencion999==='on')
            DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, '999');

        //Guardar Destinatarios para Conocimiento
        if($request->conoc2==='on')
            DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '2');
        if($request->conoc12==='on')
            DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '12');
        if($request->conoc14==='on')
            DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '14');
        if($request->conoc15==='on')
            DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '15');
        if($request->conoc16==='on')
            DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '16');
        if($request->conoc17==='on')
            DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '17');
        if($request->conoc18==='on')
            DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '18');
        if($request->conoc999==='on')
            DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, '999');

        return redirect()->route('documentos.index')
                         ->with('success','Documento guardado satisfactoriamente');
    }

    public function editar_documento($id_documento)
    {
        $documento          = Documento::where('iid_documento','=',$id_documento)->first();
        if($documento->cfolio_relacionado!=""){
            $existe_doct_rel  = Documento::where('cfolio','=',$documento->cfolio_relacionado)->where('iestatus','=',1)->count();
            if ($existe_doct_rel>0)
                $doct_relacionado = Documento::where('cfolio','=',$documento->cfolio_relacionado)->where('iestatus','=',1)->first();
            else 
                $doct_relacionado = new Documento();
        } else {
            $doct_relacionado = new Documento();
        }
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
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar           = '';
        //Auxiliar para que pinte Checkboxes, si nuevo_registro=1, entonces van sin checkear
        $nuevo_registro     = '0';
        return view('documentos.editar',compact('documento','doct_relacionado','listTipoDocumento','listTipoAnexo','listEstatus','listPrioridad','listPersonal','remitente','listPuesto','puesto','listAdscripcion','adscripcion','listImportancia','listTema','listAsunto','listInstruccion','listDestinAtn','listDestinConoc','pers_remitente','pers_conoc','pers_cncmnt','destinAtt','destinAtt_total','destinCon','destinCon_total','noeditar','nuevo_registro'));
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
        $documento->cfolio_relacionado          = $request->folio_relacionado;
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

        //Destinatarios de Copia de Conocimiento
        $totPersAnt                             = PersonalConocimiento::where('iid_documento','=',$idDocumento)->where('iestatus','=',1)->count();
        if($totPersAnt>0){
            $PersonalAnt                        = PersonalConocimiento::where('iid_documento','=',$idDocumento)->where('iestatus','=',1)->first();
            $idPersonalAnt                      = $PersonalAnt->iid_personal;
        } else {
            $idPersonalAnt                      = 0;
        }
        if($idPersonalAnt!=$request->nombre_destinatariocc)
            PersonalConocimientoController::actualiza_personal_conoc($idDocumento, $request->nombre_destinatariocc, $idPersonalAnt);
        //SEGUIMIENTO PERSONAL CONOCIMIENTO
        if($request->num_doc_seguim!=""){
            $personal_conocimiento                          = PersonalConocimiento::where('iid_documento','=',$idDocumento)
                                                                      ->where('iid_personal','=',$request->nombre_destinatariocc)->first();
            $jsonBefore                                     = json_encode($personal_conocimiento);
            $personal_conocimiento->cnum_docto_seguim       = $request->num_doc_seguim;
            $personal_conocimiento->iid_tipo_documento      = $request->tipo_doc_seg;
            $personal_conocimiento->iid_estatus_documento   = $request->estatus_doc_seg;
            $personal_conocimiento->dfecha_seguimiento      = $request->fecha_seguimiento;
            $personal_conocimiento->cseguimiento            = $request->seguimiento;

            //Manejo del archivo PDF
            if($request->hasFile("archivo_seguim")){
                $file=$request->file("archivo_seguim");
                
                $nombre = "pdf_".time().".".$file->guessExtension();

                $ruta = public_path("pdf/".$nombre);

                if($file->guessExtension()=="pdf"){
                    copy($file, $ruta);
                    $personal_conocimiento->cruta_archivo_seguim = $ruta;
                }else{
                    $personal_conocimiento->cruta_archivo_seguim = '';
                    dd("NO ES UN PDF");
                }
            }
            //Fin de Manejo del archivo PDF

            $personal_conocimiento->iestatus                = 1;
            $personal_conocimiento->iid_usuario             = auth()->user()->id;
            $personal_conocimiento->save();
            $jsonAfter                                      = json_encode($personal_conocimiento);
            PersonalConocimientoController::bitacora($jsonBefore,$jsonAfter);
        }


        //Actualizar Destinatarios para Atención
        if($request->atencion2==='on')
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '2', 1);
        else
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '2', 0);
        if($request->atencion12==='on')
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '12', 1);
        else
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '12', 0);
        if($request->atencion14==='on')
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '14', 1);
        else
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '14', 0);
        if($request->atencion15==='on')
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '15', 1);
        else
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '15', 0);
        if($request->atencion16==='on')
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '16', 1);
        else
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '16', 0);
        if($request->atencion17==='on')
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '17', 1);
        else
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '17', 0);
        if($request->atencion18==='on')
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '18', 1);
        else
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '18', 0);
        if($request->atencion999==='on')
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '999', 1);
        else
            DestinatarioAtencionController::actualiza_adscrip_atencion($idDocumento, '999', 0);

        //Actualizar Destinatarios para Conocimiento
        if($request->conoc2==='on')
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '2', 1);
        else
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '2', 0);
        if($request->conoc12==='on')
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '12', 1);
        else
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '12', 0);
        if($request->conoc14==='on')
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '14', 1);
        else
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '14', 0);
        if($request->conoc15==='on')
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '15', 1);
        else
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '15', 0);
        if($request->conoc16==='on')
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '16', 1);
        else
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '16', 0);
        if($request->conoc17==='on')
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '17', 1);
        else
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '17', 0);
        if($request->conoc18==='on')
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '18', 1);
        else
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '18', 0);
        if($request->conoc999==='on')
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '999', 1);
        else
            DestinatarioConocimientoController::actualiza_adscrip_conoc($idDocumento, '999', 0);

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
        $listPuesto         = Puesto::where('iestatus','=',1)->get();
        $listAdscripcion    = Adscripcion::where('iestatus','=',1)->get();
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
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar           = 'disabled';
        //Auxiliar para que pinte Checkboxes, si nuevo_registro=1, entonces van sin checkear
        $nuevo_registro     = '0';
        return view('documentos.inhabilitar',compact('documento','listTipoDocumento','listTipoAnexo','listEstatus','listPrioridad','listPersonal','listPuesto','listAdscripcion','listImportancia','listTema','listAsunto','listInstruccion','listDestinAtn','listDestinConoc','pers_remitente','pers_cncmnt','destinAtt','destinAtt_total','destinCon','destinCon_total','noeditar','nuevo_registro'));
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
                    'exito' => 1
                ]
            );
        }
    }
}
