<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Gestion\Documento;
use App\Models\Gestion\FolioRelacionado;
use App\Models\Gestion\Bitacora;

use Mpdf\Mpdf;

use \stdClass;
use \Datetime;
use \DateInterval;

class FolioRelacionadoController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

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
}
