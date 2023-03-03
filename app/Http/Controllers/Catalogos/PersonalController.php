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

    public function actualizar_personal_pstoads($id_personal)
    {
        $personal     = Personal::where('iid_personal','=',$id_personal)->first();
        $listPuestos  = Puesto::where('iestatus','=',1)->get();
        $listAdscrips = Adscripcion::where('iestatus','=',1)->get();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar = '';
        return view('personal.actualizar',compact('personal','listPuestos','listAdscrips','noeditar'));
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
        $personal_rem     = Personal::where('cnombre_personal','like','%'.$nr.'%')
                                    ->orWhere('cpaterno_personal','like','%'.$nr.'%')
                                    ->orWhere('cmaterno_personal','like','%'.$nr.'%')
                                    ->orWhere('cnombre_personal','=',mb_strimwidth($nr,0,strpos($nr, " ")))
                                    ->orWhere('cpaterno_personal','=',mb_strimwidth($nr,0,strpos($nr, " ")))
                                    ->orWhere('cmaterno_personal','=',mb_strimwidth($nr,0,strpos($nr, " ")))
                                    ->orWhere('cnombre_personal','=',mb_strimwidth($nr,strpos($nr, " ")+1,strlen($nr)))
                                    ->orWhere('cpaterno_personal','=',mb_strimwidth($nr,strpos($nr, " ")+1,strlen($nr)))
                                    ->orWhere('cmaterno_personal','=',mb_strimwidth($nr,strpos($nr, " ")+1,strlen($nr)))
                                    ->where('iestatus','=',1)->get();
        if(!$personal_rem->isEmpty()){
            $idRemitente  = $personal_rem[0]->iid_personal;
            $nombreRemtte = $personal_rem[0]->cnombre_personal.' '.$personal_rem[0]->cpaterno_personal.' '.$personal_rem[0]->cmaterno_personal;
            $listaNR      = $personal_rem;
            $listaPuesto  = Puesto::where('iid_puesto','=',$personal_rem[0]->iid_puesto)->where('iestatus','=',1)->get();
            $listaAdscrip = Adscripcion::where('iid_adscripcion','=',$personal_rem[0]->iid_adscripcion)->where('iestatus','=',1)->get();
            return response()->json(
                [
                    'idRemitente'  => $idRemitente,
                    'nombreRemtte' => $nombreRemtte,
                    'listaNR'      => $listaNR,
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
                    'listaNR'      => null,
                    'listaPuesto'  => null,
                    'listaAdscrip' => null,
                    'exito'        => 0
                ]
            );
        }
    }


    public static function actualizaPuestoAdscrip(Request $request){
        $idrmtte            = $request->lnr;
        $remitente          = Personal::where('iid_personal','=',$idrmtte)->get();
        if (!$remitente->isEmpty()){
            $puesto         = Puesto::where('iid_puesto','=',$remitente[0]->iid_puesto)->get();
            $adscripcion    = Adscripcion::where('iid_adscripcion','=',$remitente[0]->iid_adscripcion)->get();
            return response()->json(
                [
                    'puesto'        => $puesto,
                    'adscripcion'   => $adscripcion,
                    'exito'         => 1
                ]
            );
        } else {
            return response()->json(
                [
                    'puesto'        => null,
                    'adscripcion'   => null,
                    'exito'         => 0
                ]
            );
        }
    }

    public static function buscaOtroNombre(Request $request){
        $on               = $request->on;
        $otro_personal    = Personal::where('cnombre_personal','=',$on)->where('iestatus','=',1)->get();
        if(!$otro_personal->isEmpty()){
            $idOtroPers   = $otro_personal[0]->iid_personal;
            $nombreOtroP  = $otro_personal[0]->cnombre_personal;
            $paternoOtroP = $otro_personal[0]->cpaterno_personal;
            $maternoOtroP = $otro_personal[0]->cmaterno_personal;
            $puestoOtroP  = Puesto::where('iid_puesto','=',$otro_personal[0]->iid_puesto)->where('iestatus','=',1)->first();
            $idOtroPuesto = $puestoOtroP->iid_puesto;
            $descOtroPsto = $puestoOtroP->cdescripcion_puesto;
            $adscripOtroP = Adscripcion::where('iid_adscripcion','=',$otro_personal[0]->iid_adscripcion)->where('iestatus','=',1)->first();
            $idOtraAdsc   = $adscripOtroP->iid_adscripcion;
            $descOtraAdsc = $adscripOtroP->cdescripcion_adscripcion;
            $tipoOtraAdsc = $adscripOtroP->iid_tipo_area;
            return response()->json(
                [
                    'idOtroPers'   => $idOtroPers,
                    'nombreOtroP'  => $nombreOtroP,
                    'paternoOtroP' => $paternoOtroP,
                    'maternoOtroP' => $maternoOtroP,
                    'idOtroPuesto' => $idOtroPuesto,
                    'descOtroPsto' => $descOtroPsto,
                    'idOtraAdsc'   => $idOtraAdsc,
                    'descOtraAdsc' => $descOtraAdsc,
                    'tipoOtraAdsc' => $tipoOtraAdsc,
                    'exito'        => 1
                ]
            );
        } else {
            return response()->json(
                [
                    'idOtroPers'   => null,
                    'nombreOtroP'  => null,
                    'paternoOtroP' => null,
                    'maternoOtroP' => null,
                    'idOtroPuesto' => null,
                    'descOtroPsto' => null,
                    'idOtraAdsc'   => null,
                    'descOtraAdsc' => null,
                    'tipoOtraAdsc' => null,
                    'exito'        => 0
                ]
            );
        }
    }
}
