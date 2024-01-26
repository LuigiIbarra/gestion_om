<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Catalogos\PersonalController;
use App\Http\Controllers\Catalogos\PuestosController;
use App\Http\Controllers\Catalogos\AdscripcionesController;

use App\Models\Gestion\Documento;
use App\Models\Catalogos\Puesto;
use App\Models\Catalogos\Adscripcion;
use App\Models\Catalogos\Personal;
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
        $destinatario_atencion->iid_otro_personal       = $request->idOtroPersonal;
        $destinatario_atencion->iid_otro_puesto         = $request->idOtroPuesto;
        $destinatario_atencion->iid_otra_adscripcion    = $request->idOtraAdscrip;
        $destinatario_atencion->cnum_docto_resp         = $request->num_doc_seguim;
        $destinatario_atencion->crespuesta              = $request->seguimiento;
        $destinatario_atencion->iid_tipo_documento      = $request->tipo_doc_seg;
        $destinatario_atencion->iid_estatus_documento   = $request->estatus_doc_seg;
        $destinatario_atencion->dfecha_concluido        = $request->fecha_seguimiento;
        if ($request->id_area==1355) {
            if($request->idOtroPersonal=="" && $request->idOtroPuesto=="" && $request->idOtraAdscrip==""){
                if($request->otro_nvo_puesto==""){
            //Guardar otro Puesto
                    $otro_puesto                                = new Puesto();
                    $jsonBeforeOtroPuesto                       = "NEW INSERT PUESTO";
                    $otro_puesto->cdescripcion_puesto           = $request->otra_desc_puesto;
                    $otro_puesto->iestatus                      = 1;
                    $otro_puesto->iid_usuario                   = auth()->user()->id;
                    $otro_puesto->save();
                    $jsonAfterOtroPuesto                        = json_encode($otro_puesto);
                    PuestosController::bitacora($jsonBeforeOtroPuesto,$jsonAfterOtroPuesto);
                    $destinatario_atencion->iid_otro_puesto     = $otro_puesto->iid_puesto;
                } else {
                    $destinatario_atencion->iid_otro_puesto     = $request->otro_nvo_puesto;
                }
                if($request->otra_nva_adscripcion==""){
            //Guardar otra Adscripción
                    $otra_adscripcion                           = new Adscripcion();
                    $jsonBeforeOtraAdscrip                      = "NEW INSERT ADSCRIPCION";
                    $otra_adscripcion->cdescripcion_adscripcion = $request->otra_desc_adsc;
                    $otra_adscripcion->iid_tipo_area            = $request->nvo_tipo_adscripcion;
                    $otra_adscripcion->iestatus                 = 1;
                    $otra_adscripcion->iid_usuario              = auth()->user()->id;
                    $otra_adscripcion->save();
                    $jsonAfterOtraAdscrip                       = json_encode($otra_adscripcion);
                    AdscripcionesController::bitacora($jsonBeforeOtraAdscrip,$jsonAfterOtraAdscrip);
                    $destinatario_atencion->iid_otra_adscripcion = $otra_adscripcion->iid_adscripcion;
                } else {
                    $destinatario_atencion->iid_otra_adscripcion = $request->otra_nva_adscripcion;
                }
                if($request->idOtroPersonal==""){
            //Guardar otro Personal
                    $otro_personal                              = new Personal();
                    $jsonBeforeOtroPersonal                     = "NEW INSERT PERSONAL";
                    $otro_personal->cnombre_personal            = $request->nuevo_nombre;
                    $otro_personal->cpaterno_personal           = $request->otro_paterno;
                    $otro_personal->cmaterno_personal           = $request->otro_materno;
                    if($request->otro_nvo_puesto=="")
                        $otro_personal->iid_puesto              = $otro_puesto->iid_puesto;
                    else
                        $otro_personal->iid_puesto              = $request->otro_nvo_puesto;
                    if($request->otra_nva_adscripcion=="")
                        $otro_personal->iid_adscripcion         = $otra_adscripcion->iid_adscripcion;
                    else
                        $otro_personal->iid_adscripcion         = $request->otra_nva_adscripcion;
                    $otro_personal->iestatus                    = 1;
                    $otro_personal->iid_usuario                 = auth()->user()->id;
                    $otro_personal->save();
                    $jsonAfterOtroPersonal                      = json_encode($otro_personal);
                    PersonalController::bitacora($jsonBeforeOtroPersonal,$jsonAfterOtroPersonal);
                    $destinatario_atencion->iid_otro_personal   = $otro_personal->iid_personal;
                } else {
                    $destinatario_atencion->iid_otro_personal   = $request->idOtroPersonal;
                }
            }
        }

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

    public function guarda_otra_persona(string $idDocumento, string $otro_puesto_ac, string $otra_adscripcion_ac, string $otro_personal_ac){
        $destinatario_atencion                      = new DestinatarioAtencion();
        $jsonBefore                                 = "NEW INSERT ADSCRIPCION_ATENCION";
        $destinatario_atencion->iid_documento       = $idDocumento;
        $destinatario_atencion->iid_adscripcion     = 1355;
        $destinatario_atencion->iid_otro_personal   = $otro_personal_ac;
        $destinatario_atencion->iid_otro_puesto     = $otro_puesto_ac;
        $destinatario_atencion->iid_otra_adscripcion= $otra_adscripcion_ac;
        $destinatario_atencion->iestatus            = 1;
        $destinatario_atencion->iid_usuario         = auth()->user()->id;
        $destinatario_atencion->save();
        $jsonAfter                                  = json_encode($destinatario_atencion);
        DestinatarioAtencionController::bitacora($jsonBefore,$jsonAfter);
    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }
}
