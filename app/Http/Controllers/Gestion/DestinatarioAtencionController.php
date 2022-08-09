<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Gestion\Documento;
use App\Models\Catalogos\Adscripcion;
use App\Models\Gestion\DestinatarioAtencion;
use App\Models\Gestion\Bitacora;

use Mpdf\Mpdf;

use \stdClass;
use \Datetime;
use \DateInterval;

class DestinatarioAtencionController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

    public static function guarda_adscrip_atencion(string $idDocumento, string $idAdscripcion){
        $destinatario_atencion                  = new DestinatarioAtencion();
        $jsonBefore                             = "NEW INSERT ADSCRIPCION_ATENCION";
        $destinatario_atencion->iid_documento   = $idDocumento;
        $destinatario_atencion->iid_adscripcion = $idAdscripcion;
        $destinatario_atencion->iestatus        = 1;
        $destinatario_atencion->iid_usuario     = auth()->user()->id;
        $destinatario_atencion->save();
        $jsonAfter                              = json_encode($destinatario_atencion);
        DestinatarioAtencionController::bitacora($jsonBefore,$jsonAfter);
    }

    public static function actualiza_adscrip_atencion(string $idDocumento, string $idAdscripcion, string $checked){
    //Primero debemos averiguar si hay registro de la adscripción
        $siHayAdscrip                           = DestinatarioAtencion::where('iid_documento','=',$idDocumento)
                                                                      ->where('iid_adscripcion','=',$idAdscripcion)->count();
    //Si hay, lo actualizamos
        if($siHayAdscrip>0){
            $destinatario_atencion              = DestinatarioAtencion::where('iid_documento','=',$idDocumento)
                                                                      ->where('iid_adscripcion','=',$idAdscripcion)->first();
    //Sí el estatus es igual la checked, no se actualiza el registro
            if($destinatario_atencion->iestatus==$checked)
                return;
            $jsonBefore                         = json_encode($destinatario_atencion);                                                      
        } else {
    //No hay y el checked es 0, no guardamos registro
            if($checked==0)
                return;
    //No hay y el checked es 1, lo registramos
            $destinatario_atencion              = new DestinatarioAtencion();
            $jsonBefore                         = "NEW INSERT ADSCRIPCION_ATENCION";
        }
        $destinatario_atencion->iid_documento   = $idDocumento;
        $destinatario_atencion->iid_adscripcion = $idAdscripcion;
        $destinatario_atencion->iestatus        = $checked;
        $destinatario_atencion->iid_usuario     = auth()->user()->id;
        $destinatario_atencion->save();
        $jsonAfter                              = json_encode($destinatario_atencion);
        DestinatarioAtencionController::bitacora($jsonBefore,$jsonAfter);
    }

    //Actualizar SEGUIMIENTO Destinatarios para Atención
    public function seguimiento(Request $request){
        $destinatario_atencion                          = DestinatarioAtencion::where('iid_destinatario_atencion','=',$request->id_dest_at)->first();
        $jsonBefore                                     = json_encode($destinatario_atencion);
        $destinatario_atencion->iid_documento           = $request->id_docto;
        $destinatario_atencion->iid_adscripcion         = $request->id_area;
        $destinatario_atencion->cnum_docto_resp         = $request->num_doc_seguim;
        $destinatario_atencion->crespuesta              = $request->seguimiento;
        $destinatario_atencion->iid_tipo_documento      = $request->tipo_doc_seg;
        $destinatario_atencion->iid_estatus_documento   = $request->estatus_doc_seg;
        $destinatario_atencion->dfecha_concluido        = $request->fecha_seguimiento;
        if($request->id_area=="999")
            $destinatario_atencion->cdescrip_otra_adscrip = $request->otra_ads;
        else
            $destinatario_atencion->cdescrip_otra_adscrip = '';

        //Manejo del archivo PDF
        if($request->hasFile("daarchivo_seguim")){
            $file=$request->file("daarchivo_seguim");
            
            $nombre = "pdf_".time().".".$file->guessExtension();

            $ruta = public_path("pdf/".$nombre);

            if($file->guessExtension()=="pdf"){
                copy($file, $ruta);
                $destinatario_atencion->cruta_archivo_respuesta = $ruta;
            }else{
                $destinatario_atencion->cruta_archivo_respuesta = '';
                dd("NO ES UN PDF");
            }
        }
        //Fin de Manejo del archivo PDF

        $destinatario_atencion->iestatus                = 1;
        $destinatario_atencion->iid_usuario             = auth()->user()->id;
        $destinatario_atencion->save();
        $jsonAfter                                      = json_encode($destinatario_atencion);
        DestinatarioAtencionController::bitacora($jsonBefore,$jsonAfter);

        return redirect()->route('documentos.editar', $request->id_docto)
                         ->with('success','Seguimiento Atención guardado satisfactoriamente.');
    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }
}
