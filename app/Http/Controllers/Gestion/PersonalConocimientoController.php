<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Gestion\Documento;
use App\Models\Catalogos\Personal;
use App\Models\Gestion\PersonalConocimiento;
use App\Models\Catalogos\TipoDocumento;
use App\Models\Catalogos\EstatusDocumento;
use App\Models\Gestion\Bitacora;

use Mpdf\Mpdf;

use \stdClass;
use \Datetime;
use \DateInterval;

class PersonalConocimientoController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

    public function nuevo_persconoc(string $idDocumento){
        $documento                              = Documento::where('iid_documento','=',$idDocumento)->where('iestatus','=',1)->first();
        $personal_conocimiento                  = new PersonalConocimiento();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar = '';
        return view('pers_conoc.nuevo',compact('documento','personal_conocimiento','noeditar'));
    }

    public function guardar_nuevo_persconoc(Request $request){
        $personal_conocimiento                  = new PersonalConocimiento();
        $jsonBefore                             = "NEW INSERT PERSONAL_CONOCIMIENTO";
        $personal_conocimiento->iid_documento   = $request->idDocumento;
        $personal_conocimiento->iid_personal    = $request->idDestinatario;
        $personal_conocimiento->iestatus        = 1;
        $personal_conocimiento->iid_usuario     = auth()->user()->id;
        $personal_conocimiento->save();
        $jsonAfter                              = json_encode($personal_conocimiento);
        PersonalConocimientoController::bitacora($jsonBefore,$jsonAfter);

        return redirect()->route('documentos.editar',$request->idDocumento)
                         ->with('success','Documento actualizado con Destinatario de Copia de Conocimiento satisfactoriamente');
    }

    public function editar_persconoc(string $idDocumento, string $idPersonal){
        $documento              = Documento::where('iid_documento','=',$idDocumento)->where('iestatus','=',1)->first();
        $personal               = Personal::with('puesto','adscripcion')->where('iid_personal','=',$idPersonal)->where('iestatus','=',1)->first();
        $personal_conocimiento  = PersonalConocimiento::where('iid_documento','=',$idDocumento)
                                                      ->where('iid_personal','=',$idPersonal)->where('iestatus','=',1)->first();
        $listTipoDocumento      = TipoDocumento::where('iestatus','=',1)->get();
        $listEstatus            = EstatusDocumento::where('iestatus','=',1)->get();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar               = '';
        return view('pers_conoc.editar',compact('personal_conocimiento','documento','personal','listTipoDocumento','listEstatus','noeditar'));
    }

    public function seguimiento_persconoc(Request $request){
        $personal_conocimiento  = PersonalConocimiento::where('iid_documento','=',$request->idDocumento)
                                                      ->where('iid_personal','=',$request->idDestinatario)->where('iestatus','=',1)->first();
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
        $personal_conocimiento->iestatus        = 1;
        $personal_conocimiento->iid_usuario     = auth()->user()->id;
        $personal_conocimiento->save();
        $jsonAfter                              = json_encode($personal_conocimiento);
        PersonalConocimientoController::bitacora($jsonBefore,$jsonAfter);

        return redirect()->route('documentos.editar',$request->idDocumento)
                         ->with('success','Documento actualizado con Seguimiento Destinatario de Copia de Conocimiento satisfactoriamente');
    }

    public static function guarda_personal_conoc(string $idDocumento, string $idPersonal){
        $personal_conocimiento                  = new PersonalConocimiento();
        $jsonBefore                             = "NEW INSERT PERSONAL_CONOCIMIENTO";
        $personal_conocimiento->iid_documento   = $idDocumento;
        $personal_conocimiento->iid_personal    = $idPersonal;
        $personal_conocimiento->iestatus        = 1;
        $personal_conocimiento->iid_usuario     = auth()->user()->id;
        $personal_conocimiento->save();
        $jsonAfter                              = json_encode($personal_conocimiento);
        PersonalConocimientoController::bitacora($jsonBefore,$jsonAfter);
    }

    public static function actualiza_personal_conoc(string $idDocumento, int $idPersonal, int $idAntPersonal){
    //Primero Borrar el anterior
        if($idAntPersonal>0) {
            $personal_conoc_ant                 = PersonalConocimiento::where('iid_documento','=',$idDocumento)
                                                                      ->where('iid_personal','=',$idAntPersonal)->first();
            $jsonBefore                         = json_encode($personal_conoc_ant);
            $personal_conoc_ant->iestatus       = 0;
            $personal_conoc_ant->iid_usuario    = auth()->user()->id;
            $personal_conoc_ant->save();
            $jsonAfter                          = json_encode($personal_conoc_ant);
            PersonalConocimientoController::bitacora($jsonBefore,$jsonAfter);
        }
    //Segundo Guardar el nuevo
        PersonalConocimientoController::guarda_personal_conoc($idDocumento, $idPersonal);
    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }
}
