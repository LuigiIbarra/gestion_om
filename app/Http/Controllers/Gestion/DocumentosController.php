<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $documento->iid_personal_remitente      = $request->nombre_remitente;
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
        $documento->cruta_archivo_documento     = $request->archivo;
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

        //Destinatarios para Atención
        if($request->destinatario_atencion>0)
            foreach($request->destinatario_atencion as $indice=>$dest_at)
                DestinatarioAtencionController::guarda_adscrip_atencion($idDocumento, $dest_at);

        //Destinatarios para Conocimiento
        if($request->destinatario_conocimiento>0)
            foreach($request->destinatario_conocimiento as $indice=>$dest_conoc)
                DestinatarioConocimientoController::guarda_adscrip_conoc($idDocumento, $dest_conoc);

        return redirect()->route('documentos.index')
                         ->with('success','Documento guardado satisfactoriamente');
    }

    public function editar_documento($id_documento)
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
        $pers_conoc_total   = PersonalConocimiento::where('iid_documento','=',$id_documento)->count();
        if($pers_conoc_total>0) {
            $pers_conoc     = PersonalConocimiento::where('iid_documento','=',$id_documento)->first();
            $pers_cncmnt    = Personal::where('iid_personal','=',$pers_conoc->iid_personal)->first();
        } else {
            $pers_conoc     = new PersonalConocimiento();
            $pers_cncmnt    = new Personal();
        }
        //Datos de Destinatario Atención
        $destinAtt_total    = DestinatarioAtencion::where('iid_documento','=',$id_documento)->count();
        if($destinAtt_total>0)
            $destinAtt      = DestinatarioAtencion::where('iid_documento','=',$id_documento)->get();
        else
            $destinAtt      = new DestinatarioAtencion();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar           = '';
        //Auxiliar para que pinte Checkboxes, si nuevo_registro=1, entonces van sin checkear
        $nuevo_registro     = '0';
        return view('documentos.editar',compact('documento','listTipoDocumento','listTipoAnexo','listEstatus','listPrioridad','listPersonal','listPuesto','listAdscripcion','listImportancia','listTema','listAsunto','listInstruccion','listDestinAtn','listDestinConoc','pers_remitente','pers_cncmnt','destinAtt','destinAtt_total','noeditar','nuevo_registro'));
    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }
}
