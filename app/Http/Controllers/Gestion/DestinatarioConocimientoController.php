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
