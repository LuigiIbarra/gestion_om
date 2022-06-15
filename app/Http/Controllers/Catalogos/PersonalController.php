<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Catalogos\Personal;
use App\Models\Catalogos\Puesto;
use App\Models\Catalogos\Adscripcion;
use App\Models\Gestion\Bitacora;

use Mpdf\Mpdf;

use \stdClass;
use \Datetime;
use \DateInterval;


class PersonalController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

    public function index(Request $request)
    {
        $nombre = $request->nombre;
        if ($nombre != "") {
            $data['personal'] = Personal::with('puesto','adscripcion')->where('cnombre_personal','like','%'.$nombre.'%')->where('iestatus','=',1)->get();
        } else {
            $data['personal'] = Personal::with('puesto','adscripcion')->where('iestatus','=',1)->get();
        }
        return view('personal.index',$data);
    }

    public function nuevo_personal()
    {
        $personal     = new Personal();
        $listPuestos  = Puesto::where('iestatus','=',1)->get();
        $listAdscrips = Adscripcion::where('iestatus','=',1)->get();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar = '';
        return view('personal.nuevo',compact('personal','listPuestos','listAdscrips','noeditar'));
    }

    public function guardar_personal(Request $request)
    {
        $now = new \DateTime();
        $personal                      = new Personal();
        $jsonBefore                    = "NEW INSERT PERSONAL";
        $personal->cnombre_personal    = $request->nombre_personal;
        $personal->cpaterno_personal   = $request->paterno_personal;
        $personal->cmaterno_personal   = $request->materno_personal;
        $personal->iid_puesto          = $request->puesto;
        $personal->iid_adscripcion     = $request->adscripcion;
        $personal->ccorreo_electronico = $request->correo_electronico;
        $personal->iestatus            = 1;
        $personal->iid_usuario         = auth()->user()->id;
        $personal->save();
        $jsonAfter                     = json_encode($personal);
        PersonalController::bitacora($jsonBefore,$jsonAfter);

        return redirect()->route('personal.index')
                         ->with('success','Personal guardado satisfactoriamente');
    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }
}
