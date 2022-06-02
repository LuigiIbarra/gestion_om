<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Catalogos\Puesto;
use App\Models\Gestion\Bitacora;

use Mpdf\Mpdf;

use \stdClass;
use \Datetime;
use \DateInterval;


class PuestosController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

    public function index(Request $request)
    {
        $puesto = $request->puesto;
        if ($puesto != "") {
            $data['puestos'] = Puesto::where('cdescripcion_puesto','like','%'.$puesto.'%')->where('iestatus','=',1)->get();
        } else {
            $data['puestos'] = Puesto::where('iestatus','=',1)->get();
        }
        return view('puestos.index',$data);
    }

    public function nuevo_puesto()
    {
        $puesto = new Puesto();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar = '';
        return view('puestos.nuevo',compact('puesto','noeditar'));
    }

    public function guardar_puesto(Request $request)
    {
        $now = new \DateTime();
        $puesto                      = new Puesto();
        $jsonBefore                  = "NEW INSERT PUESTO";
        $puesto->cdescripcion_puesto = $request->descripcion_puesto;
        $puesto->iestatus            = 1;
        $puesto->iid_usuario         = auth()->user()->id;
        $puesto->save();
        $jsonAfter                   = json_encode($puesto);
        PuestosController::bitacora($jsonBefore,$jsonAfter);

        return redirect()->route('puestos.index')
                         ->with('success','Puesto guardado satisfactoriamente');
    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }
}
