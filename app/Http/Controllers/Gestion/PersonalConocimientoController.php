<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Gestion\Documento;
use App\Models\Catalogos\Personal;
use App\Models\Gestion\PersonalConocimiento;
use App\Models\Gestion\Bitacora;

use Mpdf\Mpdf;

use \stdClass;
use \Datetime;
use \DateInterval;

class PersonalConocimientoController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

    public static function guarda_personal_conoc(string $idDocumento, string $idPersonal){
        $personal_conocimiento                = new PersonalConocimiento();
        $jsonBefore                           = "NEW INSERT PERSONAL_CONOCIMIENTO";
        $personal_conocimiento->iid_documento = $idDocumento;
        $personal_conocimiento->iid_personal  = $idPersonal;
        $personal_conocimiento->iestatus      = 1;
        $personal_conocimiento->iid_usuario   = auth()->user()->id;
        $personal_conocimiento->save();
        $jsonAfter                            = json_encode($personal_conocimiento);
        PersonalConocimientoController::bitacora($jsonBefore,$jsonAfter);
    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }
}
