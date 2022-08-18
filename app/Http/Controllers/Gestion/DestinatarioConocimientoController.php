<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Gestion\Documento;
use App\Models\Catalogos\Adscripcion;
use App\Models\Gestion\DestinatarioConocimiento;
use App\Models\Gestion\Bitacora;

use Mpdf\Mpdf;

use \stdClass;
use \Datetime;
use \DateInterval;

class DestinatarioConocimientoController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

    public static function guarda_adscrip_conoc(string $idDocumento, string $idAdscripcion){
        $destinatario_conocimiento                  = new DestinatarioConocimiento();
        $jsonBefore                                 = "NEW INSERT ADSCRIPCION_CONOCIMIENTO";
        $destinatario_conocimiento->iid_documento   = $idDocumento;
        $destinatario_conocimiento->iid_adscripcion = $idAdscripcion;
        $destinatario_conocimiento->iestatus        = 1;
        $destinatario_conocimiento->iid_usuario     = auth()->user()->id;
        $destinatario_conocimiento->save();
        $jsonAfter                                  = json_encode($destinatario_conocimiento);
        DestinatarioConocimientoController::bitacora($jsonBefore,$jsonAfter);
    }

    public static function actualiza_adscrip_conoc(string $idDocumento, string $idAdscripcion, string $checked){
    //Primero debemos averiguar si hay registro de la adscripción
        $siHayAdscrip                               = DestinatarioConocimiento::where('iid_documento','=',$idDocumento)
                                                                              ->where('iid_adscripcion','=',$idAdscripcion)->count();
    //Si hay, lo actualizamos
        if($siHayAdscrip>0){
            $destinatario_conocimiento              = DestinatarioConocimiento::where('iid_documento','=',$idDocumento)
                                                                              ->where('iid_adscripcion','=',$idAdscripcion)->first();
    //Sí el estatus es igual la checked, no se actualiza el registro
            if($destinatario_conocimiento->iestatus==$checked)
                return;
            $jsonBefore                             = json_encode($destinatario_conocimiento);                                                      
        } else {
    //No hay y el checked es 0, no guardamos registro
            if($checked==0)
                return;
    //No hay y el checked es 1, lo registramos
            $destinatario_conocimiento              = new DestinatarioConocimiento();
            $jsonBefore                             = "NEW INSERT ADSCRIPCION_CONOCIMIENTO";
        }
        $destinatario_conocimiento->iid_documento   = $idDocumento;
        $destinatario_conocimiento->iid_adscripcion = $idAdscripcion;
        $destinatario_conocimiento->iestatus        = $checked;
        $destinatario_conocimiento->iid_usuario     = auth()->user()->id;
        $destinatario_conocimiento->save();
        $jsonAfter                                  = json_encode($destinatario_conocimiento);
        DestinatarioConocimientoController::bitacora($jsonBefore,$jsonAfter);
    }

    //Actualizar SEGUIMIENTO Destinatarios para Conocimiento
    public function seguimiento(Request $request){
        $destinatario_conocimiento                        = DestinatarioConocimiento::where('iid_destinatario_conocimiento','=',$request->id_dest_cn)->first();
        $jsonBefore                                       = json_encode($destinatario_conocimiento);
        $destinatario_conocimiento->iid_documento         = $request->id_docto;
        $destinatario_conocimiento->iid_adscripcion       = $request->id_area;
        $destinatario_conocimiento->cnum_docto_seguim     = $request->num_doc_seguim;
        $destinatario_conocimiento->cseguimiento          = $request->seguimiento;
        $destinatario_conocimiento->iid_tipo_documento    = $request->tipo_doc_seg;
        $destinatario_conocimiento->iid_estatus_documento = $request->estatus_doc_seg;
        $destinatario_conocimiento->dfecha_seguimiento    = $request->fecha_seguimiento;
        if($request->id_area=="999")
            $destinatario_conocimiento->cdescrip_otra_adscrip = $request->otra_ads;
        else
            $destinatario_conocimiento->cdescrip_otra_adscrip = '';

        //Manejo del archivo PDF
        if($request->hasFile("dcarchivo_seguim")){
            $file=$request->file("dcarchivo_seguim");
            
            $nombre = "pdf_".time().".".$file->guessExtension();

            $ruta = public_path("pdf/".$nombre);

            if($file->guessExtension()=="pdf"){
                copy($file, $ruta);
                $destinatario_conocimiento->cruta_archivo_seguim = $ruta;
            }else{
                $destinatario_conocimiento->cruta_archivo_seguim = '';
                dd("NO ES UN PDF");
            }
        }
        //Fin de Manejo del archivo PDF

        $destinatario_conocimiento->iestatus              = 1;
        $destinatario_conocimiento->iid_usuario           = auth()->user()->id;
        $destinatario_conocimiento->save();
        $jsonAfter                                        = json_encode($destinatario_conocimiento);
        DestinatarioConocimientoController::bitacora($jsonBefore,$jsonAfter);

        return redirect()->route('documentos.editar', $request->id_docto)
                         ->with('success','Seguimiento Conocimiento guardado satisfactoriamente.');
    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }
}
