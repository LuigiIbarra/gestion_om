<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Catalogos\Rol;
use App\Models\Catalogos\Permiso;
use App\Models\Catalogos\PermisoRol;
use App\Models\Gestion\Bitacora;

use Mpdf\Mpdf;

use \stdClass;
use \Datetime;
use \DateInterval;


class UsuariosController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

    public function index(Request $request)
    {
        $nombre = $request->nombre;
        if ($nombre != "") {
            $data['usuarios'] = User::with('rol')->where('name','like','%'.$nombre.'%')->get();
        } else {
            $data['usuarios'] = User::with('rol')->get();
        }
        return view('usuarios.index',$data);
    }

    public function editar_usuario($id_usuario)
    {
        $usuario      = User::with('rol')->where('id','=',$id_usuario)->first();
        $listRoles    = Rol::where('iestatus','=',1)->get();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar     = '';
        return view('usuarios.editar',compact('usuario','listRoles','noeditar'));
    }

    public function actualizar_usuario(Request $request)
    {
        $now                               = new \DateTime();
        $usuario                           = User::where('id','=',$request->id_usuario)->first();
        $jsonBefore                        = 'ACTUALIZAR USUARIO '.json_encode($usuario);
        //Se Habilita o Inhabilita el Usuario
        if ($request->noeditar == "disabled") {
            if ($usuario->iestatus == 0) {
                $operacion                 = "RECUPERADO";
                $usuario->password         = bcrypt('12345678');
                $usuario->iestatus         = 1;
            } else {
                $operacion                 = "BORRADO";
                $usuario->password         = bcrypt('87654321');
                $usuario->iestatus         = 0;
            }
        } else {
            //Se actualizan los datos del Usuario
            $operacion                     = "ACTUALIZADO";
            $usuario->name                 = $request->nombre_usuario;
            $usuario->email                = $request->correo_electronico;
            $usuario->iid_rol              = $request->rol;
            $usuario->iestatus             = 1;
        }
        $usuario->iid_usuario              = auth()->user()->id;
        $usuario->save();
        $jsonAfter                         = $operacion.' '.json_encode($usuario);
        UsuariosController::bitacora($jsonBefore,$jsonAfter);

        if ($operacion=="BORRADO") {
            return redirect()->route('usuarios.index')
                             ->with('success','Usuario '.$operacion.' satisfactoriamente');
        } else {
            return redirect()->route('usuarios.editar',$usuario->id)
                             ->with('success','Usuario '.$operacion.' satisfactoriamente');
        }
    }

    //Esta misma función se utiliza para Inhabilitar/Habilitar Usuarios
    public function confirmainhabilitar_usuario($id_usuario)
    {
        $usuario      = User::with('rol')->where('id','=',$id_usuario)->first();
        $listRoles    = Rol::where('iestatus','=',1)->get();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar     = 'disabled';
        return view('usuarios.inhabilitar',compact('usuario','listRoles','noeditar'));
    }


    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }
}
