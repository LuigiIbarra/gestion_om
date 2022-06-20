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

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }
}
