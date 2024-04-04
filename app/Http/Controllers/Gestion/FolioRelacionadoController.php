<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Gestion\Documento;
use App\Models\Gestion\FolioRelacionado;
use App\Models\Catalogos\Personal;
use App\Models\Catalogos\Puesto;
use App\Models\Catalogos\Adscripcion;
use App\Models\Gestion\Bitacora;

use Mpdf\Mpdf;

use \stdClass;
use \Datetime;
use \DateInterval;

class FolioRelacionadoController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

    public function nuevo_folio(string $idDocumento){
        $documento                             = Documento::where('iid_documento','=',$idDocumento)->where('iestatus','=',1)->first();
        $folio_relacionado                     = new FolioRelacionado();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar = 'disabled';
        return view('folios_rels.nuevo',compact('documento','folio_relacionado','noeditar'));
    }

    public function guarda_nuevo_folio_rel(Request $request){
        $ya_existe                             = FolioRelacionado::where('iid_documento','=',$request->idDocumento)
                                                                 ->where('cfolio_relacionado','=',$request->folio_relacionado)
                                                                 ->where('iestatus','=',1)->count();
        if($ya_existe>0){
            return redirect()->route('documentos.editar',$request->idDocumento)
                             ->with('danger','Este Folio Relacionado ya estaba registrado.');;
        } else {
            $folio_relacionado                     = new FolioRelacionado();
            $jsonBefore                            = "NEW INSERT FOLIO_RELACIONADO";
            $folio_relacionado->iid_documento      = $request->idDocumento;
            $folio_relacionado->cfolio_relacionado = $request->folio_relacionado;
            $folio_relacionado->iestatus           = 1;
            $folio_relacionado->iid_usuario        = auth()->user()->id;
            $folio_relacionado->save();
            $jsonAfter                             = json_encode($folio_relacionado);
            FolioRelacionadoController::bitacora($jsonBefore,$jsonAfter);
        }

        return redirect()->route('documentos.editar',$request->idDocumento)
                         ->with('success','Documento actualizado con Folio Relacionado satisfactoriamente.');
    }

    public function confirmainhabilitar_folio(string $idDocumento, string $cFolioRel){
        $docto                             = Documento::with('tipodocumento','tipoanexo','personalremitente','foliorelacionado')
                                                          ->where('iid_documento','=',$idDocumento)
                                                          ->where('iestatus','=',1)->first();
        $folio_relacionado                 = FolioRelacionado::with('documento')
                                                          ->where('iid_documento','=',$idDocumento)
                                                          ->where('cfolio_relacionado','=',$cFolioRel)
                                                          ->where('iestatus','=',1)->first();
        $docto_relacionado                 = Documento::with('tipodocumento','tipoanexo','personalremitente')
                                                          ->where('cfolio','=',$cFolioRel)
                                                          ->where('iestatus','=',1)->first();                                                          
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar = 'readonly';
        return view('folios_rels.inhabilitar',compact('docto','folio_relacionado','docto_relacionado','noeditar'));
    }

    public function inhabilitar_folio(Request $request){
        $folio_relacionado                     = FolioRelacionado::where('iid_documento','=',$request->idDocumento)
                                                                 ->where('cfolio_relacionado','=',$request->idFolioRel)
                                                                 ->where('iestatus','=',1)->first();
        $jsonBefore                            = json_encode($folio_relacionado);
        $folio_relacionado->iestatus           = 0;
        $folio_relacionado->iid_usuario        = auth()->user()->id;
        $folio_relacionado->save();
        $jsonAfter                             = json_encode($folio_relacionado);
        FolioRelacionadoController::bitacora($jsonBefore,$jsonAfter);

        return redirect()->route('documentos.editar',$request->idDocumento)
                         ->with('success','Folio Relacionado Borrado de la lista satisfactoriamente');
    }
    public static function guarda_folio_relacionado(string $idDocumento, string $folioRelacionado){
        $folio_relacionado                     = new FolioRelacionado();
        $jsonBefore                            = "NEW INSERT FOLIO_RELACIONADO";
        $folio_relacionado->iid_documento      = $idDocumento;
        $folio_relacionado->cfolio_relacionado = $folioRelacionado;
        $folio_relacionado->iestatus           = 1;
        $folio_relacionado->iid_usuario        = auth()->user()->id;
        $folio_relacionado->save();
        $jsonAfter                             = json_encode($folio_relacionado);
        FolioRelacionadoController::bitacora($jsonBefore,$jsonAfter);
    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }

    public static function buscaFolioRelacionado(Request $request){
        $fr              = $request->fr;
        $folrel          = Documento::with('tipodocumento','tipoanexo')->where('cfolio','=',$fr)->where('iestatus','=',1)->get();
        if(!$folrel->isEmpty()){
            $remtte      = Personal::with('puesto','adscripcion')->where('iid_personal','=',$folrel[0]->iid_personal_remitente)
                                                                 ->where('iestatus','=',1)->first();
            $fec_recep   = $folrel[0]->dfecha_recepcion;
            $num_docto   = $folrel[0]->cnumero_documento;
            $fec_docto   = $folrel[0]->dfecha_documento;
            $tip_docto   = $folrel[0]->tipodocumento->cdescripcion_tipo_documento;
            $tip_anexo   = $folrel[0]->tipoanexo->cdescripcion_tipo_anexo;
            $nom_remtte  = $remtte->cnombre_personal.' '.$remtte->cpaterno_personal.' '.$remtte->cmaterno_personal;
            $psto_remtte = $remtte->puesto->cdescripcion_puesto;
            $adsc_remtte = $remtte->adscripcion->cdescripcion_adscripcion;
            return response()->json(
                [
                    'fec_recep'     => $fec_recep,
                    'num_docto'     => $num_docto,
                    'fec_docto'     => $fec_docto,
                    'tip_docto'     => $tip_docto,
                    'tip_anexo'     => $tip_anexo,
                    'nom_remtte'    => $nom_remtte,
                    'psto_remtte'   => $psto_remtte,
                    'adsc_remtte'   => $adsc_remtte,
                    'exito'         => 1
                ]
            );
        } else {
            return response()->json(
                [
                    'fec_recep'     => null,
                    'num_docto'     => null,
                    'fec_docto'     => null,
                    'tip_docto'     => null,
                    'tip_anexo'     => null,
                    'nom_remtte'    => null,
                    'psto_remtte'   => null,
                    'adsc_remtte'   => null,
                    'exito' => 0
                ]
            );
        }
    }
}
