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
        $now                           = new \DateTime();
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

    public function editar_personal($id_personal)
    {
        $personal     = Personal::where('iid_personal','=',$id_personal)->first();
        $listPuestos  = Puesto::where('iestatus','=',1)->get();
        $listAdscrips = Adscripcion::where('iestatus','=',1)->get();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar = '';
        return view('personal.editar',compact('personal','listPuestos','listAdscrips','noeditar'));
    }

    public function actualizar_personal(Request $request)
    {
        $now                               = new \DateTime();
        $personal                          = Personal::where('iid_personal','=',$request->id_personal)->first();
        $jsonBefore                        = json_encode($personal);
        //Se Habilita o Inhabilita el Puesto
        if ($request->noeditar == "disabled") {
            if ($personal->iestatus == 0) {
                $operacion                 = "RECUPERADO";
                $personal->iestatus        = 1;
            } else {
                $operacion                 = "BORRADO";
                $personal->iestatus        = 0;
            }
        } else {
            //Se actualizan los datos del Puesto
            $operacion                     = "ACTUALIZADO";
            $personal->cnombre_personal    = $request->nombre_personal;
            $personal->cpaterno_personal   = $request->paterno_personal;
            $personal->cmaterno_personal   = $request->materno_personal;
            $personal->iid_puesto          = $request->puesto;
            $personal->iid_adscripcion     = $request->adscripcion;
            $personal->ccorreo_electronico = $request->correo_electronico;
            $personal->iestatus            = 1;
        }
        $personal->iid_usuario             = auth()->user()->id;
        $personal->save();
        $jsonAfter                         = json_encode($personal);
        PersonalController::bitacora($jsonBefore,$jsonAfter);

        return redirect()->route('personal.index')
                         ->with('success','Personal '.$operacion.' satisfactoriamente');
    }

    //Esta misma función se utiliza para Inhabilitar/Habilitar el Personal
    public function confirmainhabilitar_personal($id_personal)
    {
        $personal     = Personal::where('iid_personal','=',$id_personal)->first();
        $listPuestos  = Puesto::where('iestatus','=',1)->get();
        $listAdscrips = Adscripcion::where('iestatus','=',1)->get();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar     = 'disabled';
        return view('personal.inhabilitar',compact('personal','listPuestos','listAdscrips','noeditar'));
    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }

    public static function buscaPuestoAdscrip(Request $request){
        $nr               = $request->nr;
        $personal_rem     = Personal::where('cnombre_personal','like','%'.$nr.'%')->where('iestatus','=',1)->get();
        if(!$personal_rem->isEmpty()){
            $idRemitente  = $personal_rem[0]->iid_personal;
            $nombreRemtte = $personal_rem[0]->cnombre_personal.' '.$personal_rem[0]->cpaterno_personal.' '.$personal_rem[0]->cmaterno_personal;
            $listaPuesto  = Puesto::where('iid_puesto','=',$personal_rem[0]->iid_puesto)->where('iestatus','=',1)->get();
            $listaAdscrip = Adscripcion::where('iid_adscripcion','=',$personal_rem[0]->iid_adscripcion)->where('iestatus','=',1)->get();
            return response()->json(
                [
                    'idRemitente'  => $idRemitente,
                    'nombreRemtte' => $nombreRemtte,
                    'listaPuesto'  => $listaPuesto,
                    'listaAdscrip' => $listaAdscrip,
                    'exito'        => 1
                ]
            );
        } else {
            return response()->json(
                [
                    'idRemitente'  => null,
                    'nombreRemtte' => null,
                    'listaPuesto'  => null,
                    'listaAdscrip' => null,
                    'exito'        => 0
                ]
            );
        }
    }
}
