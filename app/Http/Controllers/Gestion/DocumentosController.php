<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Gestion\Documento;
use App\Models\Catalogos\Puesto;
use App\Models\Catalogos\Adscripcion;
use App\Models\Catalogos\Personal;
use App\Models\Catalogos\TipoDocumento;
use App\Models\Catalogos\TipoAnexo;
use App\Models\Catalogos\EstatusDocumento;
use App\Models\Catalogos\PrioridadDocumento;
use App\Models\Catalogos\ImportanciaContenido;
use App\Models\Catalogos\Tema;
use App\Models\Catalogos\TipoAsunto;
use App\Models\Catalogos\Instruccion;
use App\Models\Gestion\DestinatarioAtencion;
use App\Models\Gestion\DestinatarioConocimiento;
use App\Models\Gestion\Bitacora;

use Mpdf\Mpdf;

use \stdClass;
use \Datetime;
use \DateInterval;

class DocumentosController extends Controller
{
    //Formato de Fechas MySQL
    protected $dateFormat = 'Y-m-d H:i:s';

    public function index(Request $request)
    {
        $folio = $request->folio;
        if ($folio != "") {
            $data['documentos'] = Documento::with('tipodocumento','tipoanexo','estatusdocumento','prioridaddocumento','importanciacontenido','tema','tipoasunto','instruccion','personalremitente','personalconocimiento','destinatarioatencion','destinatarioconocimiento')->where('ifolio','=',$folio)->where('iestatus','=',1)->get();
        } else {
            $data['documentos'] = Documento::with('tipodocumento','tipoanexo','estatusdocumento','prioridaddocumento','importanciacontenido','tema','tipoasunto','instruccion','personalremitente','personalconocimiento','destinatarioatencion','destinatarioconocimiento')->where('iestatus','=',1)->get();
        }
        return view('documentos.index',$data);
    }

    public function nuevo_documento()
    {
        $documento         = new Documento();
        $listTipoDocumento = TipoDocumento::where('iestatus','=',1)->get();
        $listTipoAnexo     = TipoAnexo::where('iestatus','=',1)->get();
        $listEstatus       = EstatusDocumento::where('iestatus','=',1)->get();
        $listPrioridad     = PrioridadDocumento::where('iestatus','=',1)->get();
        $listPersonal      = Personal::where('iestatus','=',1)->get();
        $listPuesto        = Puesto::where('iestatus','=',1)->get();
        $listAdscripcion   = Adscripcion::where('iestatus','=',1)->get();
        $listImportancia   = ImportanciaContenido::where('iestatus','=',1)->get();
        $listTema          = Tema::where('iestatus','=',1)->get();
        $listAsunto        = TipoAsunto::where('iestatus','=',1)->get();
        $listInstruccion   = Instruccion::where('iestatus','=',1)->get();
        $listDestinAtn     = Adscripcion::where('iid_tipo_area','=',4)->where('iestatus','=',1)->get();
        $listDestinConoc   = Adscripcion::where('iid_tipo_area','=',4)->where('iestatus','=',1)->get();
        //Auxiliar para indicar campos deshabilitados (disabled), ''=habilitados
        $noeditar = '';
        return view('documentos.nuevo',compact('documento','listTipoDocumento','listTipoAnexo','listEstatus','listPrioridad','listPersonal','listPuesto','listAdscripcion','listImportancia','listTema','listAsunto','listInstruccion','listDestinAtn','listDestinConoc','noeditar'));
    }

    public function guardar_documento(Request $request)
    {
        $now = new \DateTime();

    }

    public static function bitacora(string $jsonBefore,string $jsonAfter){
        $bitacora = new Bitacora();
        $bitacora->cjson_antes   = ($jsonBefore==null ? 'NEW INSERT': $jsonBefore);
        $bitacora->cjson_despues = $jsonAfter;
        $bitacora->iid_usuario   = auth()->user()->id;
        $bitacora->save();
    }
}
