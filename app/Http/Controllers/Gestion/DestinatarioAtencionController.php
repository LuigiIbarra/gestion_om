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
//OFICIALIA MAYOR OM, id=2
    public function OMseguimiento(Request $request){
    //Primero debemos averiguar si hay registro de la adscripción
        $siHayAdscrip                           = DestinatarioAtencion::where('iid_documento','=',$request->omdaid_docto)
                                                                      ->where('iid_adscripcion','=',2)->count();
    //Si hay, lo actualizamos
        if($siHayAdscrip>0){
            $destinatario_atencion              = DestinatarioAtencion::where('iid_documento','=',$request->omdaid_docto)
                                                                      ->where('iid_adscripcion','=',2)->first();
            $jsonBefore                         = json_encode($destinatario_atencion);                                                      
        } else {
    //No hay y el checked es 1, lo registramos como nuevo
            $destinatario_atencion                      = new DestinatarioAtencion();
            $jsonBefore                                 = "NEW INSERT ADSCRIPCION_ATENCION";
        }
        $destinatario_atencion->iid_documento           = $request->omdaid_docto;
        $destinatario_atencion->iid_adscripcion         = 2;
        $destinatario_atencion->cnum_docto_resp         = $request->OMnum_doc_seguim;
        $destinatario_atencion->crespuesta              = $request->OMseguimiento;
        $destinatario_atencion->iid_tipo_documento      = $request->OMtipo_doc_seg;
        $destinatario_atencion->iid_estatus_documento   = $request->OMestatus_doc_seg;
        $destinatario_atencion->dfecha_concluido        = $request->OMfecha_seguimiento;

        //Manejo del archivo PDF
        if($request->hasFile("OMarchivo_seguim")){
            $file=$request->file("OMarchivo_seguim");
            
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

        return redirect()->route('documentos.editar', $request->omdaid_docto)
                         ->with('success','Seguimiento Atención OM guardado satisfactoriamente.');
    }

//PLANEACION PL, id=12
    public function PLseguimiento(Request $request){
    //Primero debemos averiguar si hay registro de la adscripción
        $siHayAdscrip                           = DestinatarioAtencion::where('iid_documento','=',$request->pldaid_docto)
                                                                      ->where('iid_adscripcion','=',12)->count();
    //Si hay, lo actualizamos
        if($siHayAdscrip>0){
            $destinatario_atencion              = DestinatarioAtencion::where('iid_documento','=',$request->pldaid_docto)
                                                                      ->where('iid_adscripcion','=',12)->first();
            $jsonBefore                         = json_encode($destinatario_atencion);                                                      
        } else {
    //No hay y el checked es 1, lo registramos como nuevo
            $destinatario_atencion                      = new DestinatarioAtencion();
            $jsonBefore                                 = "NEW INSERT ADSCRIPCION_ATENCION";
        }
        $destinatario_atencion->iid_documento           = $request->pldaid_docto;
        $destinatario_atencion->iid_adscripcion         = 12;
        $destinatario_atencion->cnum_docto_resp         = $request->PLnum_doc_seguim;
        $destinatario_atencion->crespuesta              = $request->PLseguimiento;
        $destinatario_atencion->iid_tipo_documento      = $request->PLtipo_doc_seg;
        $destinatario_atencion->iid_estatus_documento   = $request->PLestatus_doc_seg;
        $destinatario_atencion->dfecha_concluido        = $request->PLfecha_seguimiento;

        //Manejo del archivo PDF
        if($request->hasFile("PLarchivo_seguim")){
            $file=$request->file("PLarchivo_seguim");
            
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

        return redirect()->route('documentos.editar', $request->pldaid_docto)
                         ->with('success','Seguimiento Atención DEP guardado satisfactoriamente.');
    }

//GESTIÓN TECNOLÓGICA GT, id=14
    public function GTseguimiento(Request $request){
    //Primero debemos averiguar si hay registro de la adscripción
        $siHayAdscrip                           = DestinatarioAtencion::where('iid_documento','=',$request->gtdaid_docto)
                                                                      ->where('iid_adscripcion','=',14)->count();
    //Si hay, lo actualizamos
        if($siHayAdscrip>0){
            $destinatario_atencion              = DestinatarioAtencion::where('iid_documento','=',$request->gtdaid_docto)
                                                                      ->where('iid_adscripcion','=',14)->first();
            $jsonBefore                         = json_encode($destinatario_atencion);                                                      
        } else {
    //No hay y el checked es 1, lo registramos como nuevo
            $destinatario_atencion                      = new DestinatarioAtencion();
            $jsonBefore                                 = "NEW INSERT ADSCRIPCION_ATENCION";
        }
        $destinatario_atencion->iid_documento           = $request->gtdaid_docto;
        $destinatario_atencion->iid_adscripcion         = 14;
        $destinatario_atencion->cnum_docto_resp         = $request->GTnum_doc_seguim;
        $destinatario_atencion->crespuesta              = $request->GTseguimiento;
        $destinatario_atencion->iid_tipo_documento      = $request->GTtipo_doc_seg;
        $destinatario_atencion->iid_estatus_documento   = $request->GTestatus_doc_seg;
        $destinatario_atencion->dfecha_concluido        = $request->GTfecha_seguimiento;

        //Manejo del archivo PDF
        if($request->hasFile("GTarchivo_seguim")){
            $file=$request->file("GTarchivo_seguim");
            
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

        return redirect()->route('documentos.editar', $request->gtdaid_docto)
                         ->with('success','Seguimiento Atención DEGT guardado satisfactoriamente.');
    }

//RECURSOS HUMANOS RH, id=15
    public function RHseguimiento(Request $request){
    //Primero debemos averiguar si hay registro de la adscripción
        $siHayAdscrip                           = DestinatarioAtencion::where('iid_documento','=',$request->rhdaid_docto)
                                                                      ->where('iid_adscripcion','=',15)->count();
    //Si hay, lo actualizamos
        if($siHayAdscrip>0){
            $destinatario_atencion              = DestinatarioAtencion::where('iid_documento','=',$request->rhdaid_docto)
                                                                      ->where('iid_adscripcion','=',15)->first();
            $jsonBefore                         = json_encode($destinatario_atencion);                                                      
        } else {
    //No hay y el checked es 1, lo registramos como nuevo
            $destinatario_atencion                      = new DestinatarioAtencion();
            $jsonBefore                                 = "NEW INSERT ADSCRIPCION_ATENCION";
        }
        $destinatario_atencion->iid_documento           = $request->rhdaid_docto;
        $destinatario_atencion->iid_adscripcion         = 15;
        $destinatario_atencion->cnum_docto_resp         = $request->RHnum_doc_seguim;
        $destinatario_atencion->crespuesta              = $request->RHseguimiento;
        $destinatario_atencion->iid_tipo_documento      = $request->RHtipo_doc_seg;
        $destinatario_atencion->iid_estatus_documento   = $request->RHestatus_doc_seg;
        $destinatario_atencion->dfecha_concluido        = $request->RHfecha_seguimiento;

        //Manejo del archivo PDF
        if($request->hasFile("RHarchivo_seguim")){
            $file=$request->file("RHarchivo_seguim");
            
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

        return redirect()->route('documentos.editar', $request->rhdaid_docto)
                         ->with('success','Seguimiento Atención DERH guardado satisfactoriamente.');
    }

//OBRAS, MANTENIMIENTO Y SERVICIOS OB, id=16
    public function OBseguimiento(Request $request){
    //Primero debemos averiguar si hay registro de la adscripción
        $siHayAdscrip                           = DestinatarioAtencion::where('iid_documento','=',$request->obdaid_docto)
                                                                      ->where('iid_adscripcion','=',16)->count();
    //Si hay, lo actualizamos
        if($siHayAdscrip>0){
            $destinatario_atencion              = DestinatarioAtencion::where('iid_documento','=',$request->obdaid_docto)
                                                                      ->where('iid_adscripcion','=',16)->first();
            $jsonBefore                         = json_encode($destinatario_atencion);                                                      
        } else {
    //No hay y el checked es 1, lo registramos como nuevo
            $destinatario_atencion                      = new DestinatarioAtencion();
            $jsonBefore                                 = "NEW INSERT ADSCRIPCION_ATENCION";
        }
        $destinatario_atencion->iid_documento           = $request->obdaid_docto;
        $destinatario_atencion->iid_adscripcion         = 16;
        $destinatario_atencion->cnum_docto_resp         = $request->OBnum_doc_seguim;
        $destinatario_atencion->crespuesta              = $request->OBseguimiento;
        $destinatario_atencion->iid_tipo_documento      = $request->OBtipo_doc_seg;
        $destinatario_atencion->iid_estatus_documento   = $request->OBestatus_doc_seg;
        $destinatario_atencion->dfecha_concluido        = $request->OBfecha_seguimiento;

        //Manejo del archivo PDF
        if($request->hasFile("OBarchivo_seguim")){
            $file=$request->file("OBarchivo_seguim");
            
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

        return redirect()->route('documentos.editar', $request->obdaid_docto)
                         ->with('success','Seguimiento Atención DEOMS guardado satisfactoriamente.');
    }

//RECURSOS MATERIALES RM, id=17
    public function RMseguimiento(Request $request){
    //Primero debemos averiguar si hay registro de la adscripción
        $siHayAdscrip                           = DestinatarioAtencion::where('iid_documento','=',$request->rmdaid_docto)
                                                                      ->where('iid_adscripcion','=',17)->count();
    //Si hay, lo actualizamos
        if($siHayAdscrip>0){
            $destinatario_atencion              = DestinatarioAtencion::where('iid_documento','=',$request->rmdaid_docto)
                                                                      ->where('iid_adscripcion','=',17)->first();
            $jsonBefore                         = json_encode($destinatario_atencion);                                                      
        } else {
    //No hay y el checked es 1, lo registramos como nuevo
            $destinatario_atencion                      = new DestinatarioAtencion();
            $jsonBefore                                 = "NEW INSERT ADSCRIPCION_ATENCION";
        }
        $destinatario_atencion->iid_documento           = $request->rmdaid_docto;
        $destinatario_atencion->iid_adscripcion         = 17;
        $destinatario_atencion->cnum_docto_resp         = $request->RMnum_doc_seguim;
        $destinatario_atencion->crespuesta              = $request->RMseguimiento;
        $destinatario_atencion->iid_tipo_documento      = $request->RMtipo_doc_seg;
        $destinatario_atencion->iid_estatus_documento   = $request->RMestatus_doc_seg;
        $destinatario_atencion->dfecha_concluido        = $request->RMfecha_seguimiento;

        //Manejo del archivo PDF
        if($request->hasFile("RMarchivo_seguim")){
            $file=$request->file("RMarchivo_seguim");
            
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

        return redirect()->route('documentos.editar', $request->rmdaid_docto)
                         ->with('success','Seguimiento Atención DERM guardado satisfactoriamente.');
    }

//RECURSOS FINANCIEROS RF, id=18
    public function RFseguimiento(Request $request){
    //Primero debemos averiguar si hay registro de la adscripción
        $siHayAdscrip                           = DestinatarioAtencion::where('iid_documento','=',$request->rfdaid_docto)
                                                                      ->where('iid_adscripcion','=',18)->count();
    //Si hay, lo actualizamos
        if($siHayAdscrip>0){
            $destinatario_atencion              = DestinatarioAtencion::where('iid_documento','=',$request->rfdaid_docto)
                                                                      ->where('iid_adscripcion','=',18)->first();
            $jsonBefore                         = json_encode($destinatario_atencion);                                                      
        } else {
    //No hay y el checked es 1, lo registramos como nuevo
            $destinatario_atencion                      = new DestinatarioAtencion();
            $jsonBefore                                 = "NEW INSERT ADSCRIPCION_ATENCION";
        }
        $destinatario_atencion->iid_documento           = $request->rfdaid_docto;
        $destinatario_atencion->iid_adscripcion         = 18;
        $destinatario_atencion->cnum_docto_resp         = $request->RFnum_doc_seguim;
        $destinatario_atencion->crespuesta              = $request->RFseguimiento;
        $destinatario_atencion->iid_tipo_documento      = $request->RFtipo_doc_seg;
        $destinatario_atencion->iid_estatus_documento   = $request->RFestatus_doc_seg;
        $destinatario_atencion->dfecha_concluido        = $request->RFfecha_seguimiento;

        //Manejo del archivo PDF
        if($request->hasFile("RFarchivo_seguim")){
            $file=$request->file("RFarchivo_seguim");
            
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

        return redirect()->route('documentos.editar', $request->rfdaid_docto)
                         ->with('success','Seguimiento Atención DERF guardado satisfactoriamente.');
    }

//OTRO OT, id=999
    public function OTseguimiento(Request $request){
    //Primero debemos averiguar si hay registro de la adscripción
        $siHayAdscrip                           = DestinatarioAtencion::where('iid_documento','=',$request->otdaid_docto)
                                                                      ->where('iid_adscripcion','=',999)->count();
    //Si hay, lo actualizamos
        if($siHayAdscrip>0){
            $destinatario_atencion              = DestinatarioAtencion::where('iid_documento','=',$request->otdaid_docto)
                                                                      ->where('iid_adscripcion','=',999)->first();
            $jsonBefore                         = json_encode($destinatario_atencion);                                                      
        } else {
    //No hay y el checked es 1, lo registramos como nuevo
            $destinatario_atencion                      = new DestinatarioAtencion();
            $jsonBefore                                 = "NEW INSERT ADSCRIPCION_ATENCION";
        }
        $destinatario_atencion->iid_documento           = $request->otdaid_docto;
        $destinatario_atencion->iid_adscripcion         = 999;
        $destinatario_atencion->cdescrip_otra_adscrip   = $request->OTotra_ads;
        $destinatario_atencion->cnum_docto_resp         = $request->OTnum_doc_seguim;
        $destinatario_atencion->crespuesta              = $request->OTseguimiento;
        $destinatario_atencion->iid_tipo_documento      = $request->OTtipo_doc_seg;
        $destinatario_atencion->iid_estatus_documento   = $request->OTestatus_doc_seg;
        $destinatario_atencion->dfecha_concluido        = $request->OTfecha_seguimiento;

        //Manejo del archivo PDF
        if($request->hasFile("OTarchivo_seguim")){
            $file=$request->file("OTarchivo_seguim");
            
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

        return redirect()->route('documentos.editar', $request->otdaid_docto)
                         ->with('success','Seguimiento Atención OTRO guardado satisfactoriamente.');
    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }
}
