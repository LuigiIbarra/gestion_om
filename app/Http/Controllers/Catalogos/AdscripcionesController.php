<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Catalogos\Adscripcion;
use App\Models\Catalogos\TipoArea;
use App\Models\Gestion\Bitacora;

use Mpdf\Mpdf;

use \stdClass;
use \Datetime;
use \DateInterval;


class AdscripcionesController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

    public function index(Request $request)
    {
        $adscripcion = $request->adscripcion;
        if ($adscripcion != "") {
            $data['adscripciones'] = Adscripcion::with('tipoarea')->where('cdescripcion_adscripcion','like','%'.$adscripcion.'%')->where('iestatus','=',1)->get();
        } else {
            $data['adscripciones'] = Adscripcion::with('tipoarea')->where('iestatus','=',1)->get();
        }
        return view('adscripciones.index',$data);
    }

    public function nueva_adscripcion()
    {
        $adscripcion  = new Adscripcion();
        $listTipoArea = TipoArea::where('iestatus','=',1)->get();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar = '';
        return view('adscripciones.nueva',compact('adscripcion','listTipoArea','noeditar'));
    }

    public function guardar_adscripcion(Request $request)
    {
        $now                                   = new \DateTime();
        $adscripcion                           = new Adscripcion();
        $jsonBefore                            = "NEW INSERT ADSCRIPCION";
        $adscripcion->cdescripcion_adscripcion = $request->descripcion_adscripcion;
        $adscripcion->csiglas                  = $request->siglas;
        $adscripcion->iid_tipo_area            = $request->tipo_adscripcion;
        $adscripcion->iestatus                 = 1;
        $adscripcion->iid_usuario              = auth()->user()->id;
        $adscripcion->save();
        $jsonAfter                             = json_encode($adscripcion);
        AdscripcionesController::bitacora($jsonBefore,$jsonAfter);

        return redirect()->route('adscripciones.index')
                         ->with('success','Adscripción guardada satisfactoriamente');
    }

    public function editar_adscripcion($id_adscripcion)
    {
        $adscripcion  = Adscripcion::where('iid_adscripcion','=',$id_adscripcion)->first();
        $listTipoArea = TipoArea::where('iestatus','=',1)->get();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar = '';
        return view('adscripciones.editar',compact('adscripcion','listTipoArea','noeditar'));
    }

    public function actualizar_adscripcion(Request $request)
    {
        $now                                       = new \DateTime();
        $adscripcion                               = Adscripcion::where('iid_adscripcion','=',$request->id_adscripcion)->first();
        $jsonBefore                                = json_encode($adscripcion);
        //Se Habilita o Inhabilita el Puesto
        if ($request->noeditar == "disabled") {
            if ($adscripcion->iestatus == 0) {
                $operacion                         = "RECUPERADA";
                $adscripcion->iestatus             = 1;
            } else {
                $operacion                         = "BORRADA";
                $adscripcion->iestatus             = 0;
            }
        } else {
            //Se actualizan los datos del Puesto
            $operacion                             = "ACTUALIZADA";
            $adscripcion->cdescripcion_adscripcion = $request->descripcion_adscripcion;
            $adscripcion->iestatus                 = 1;
        }
        $adscripcion->iid_usuario                  = auth()->user()->id;
        $adscripcion->save();
        $jsonAfter                                 = json_encode($adscripcion);
        AdscripcionesController::bitacora($jsonBefore,$jsonAfter);

        return redirect()->route('adscripciones.index')
                         ->with('success','Adscripción '.$operacion.' satisfactoriamente');
    }

    //Esta misma función se utiliza para Inhabilitar/Habilitar la Adscripcion
    public function confirmainhabilitar_adscripcion($id_adscripcion)
    {
        $adscripcion  = Adscripcion::where('iid_adscripcion','=',$id_adscripcion)->first();
        $listTipoArea = TipoArea::where('iestatus','=',1)->get();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar = 'disabled';
        return view('adscripciones.inhabilitar',compact('adscripcion','listTipoArea','noeditar'));
    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }
}
