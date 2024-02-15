<?php

namespace App\Exports\Excel;

use App\Models\Gestion\Documento;
use App\Models\Catalogos\Puesto;
use App\Models\Catalogos\Adscripcion;
use App\Models\Catalogos\TipoArea;
use App\Models\Catalogos\Personal;
use App\Models\Catalogos\TipoDocumento;
use App\Models\Catalogos\TipoAnexo;
use App\Models\Catalogos\EstatusDocumento;
use App\Models\Catalogos\PrioridadDocumento;
use App\Models\Catalogos\Semaforo;
use App\Models\Catalogos\ImportanciaContenido;
use App\Models\Catalogos\Tema;
use App\Models\Catalogos\TipoAsunto;
use App\Models\Catalogos\Instruccion;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocumentosExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array
    {
        return [
            'Id Documento',
            'Folio',
            'Fecha Recepción',
            'Número Documento',
            'Fecha Documento',
            'Tipo Documento',
            'Tipo Anexo',
            'Remitente',
            'Paterno',
            'Materno',
            'Puesto',
            'Adscripción',
            'Estatus',
            'Prioridad',
            'Instrucción',
            'Semáforo',
            'Fecha Término',
            'Asunto',
            'Usuario',
        ];
    }

    public function collection()
    {
        /*
         * CONSULTA A MANO        
        SELECT d.iid_documento, d.cfolio, d.dfecha_recepcion, d.cnumero_documento, d.dfecha_documento, td.cdescripcion_tipo_documento,
                ta.cdescripcion_tipo_anexo, p.cnombre_personal, p.cpaterno_personal, p.cmaterno_personal, 
                (SELECT pst.cdescripcion_puesto FROM tcpuestos as pst where p.iid_puesto=pst.iid_puesto) as puesto,
                (SELECT ads.cdescripcion_adscripcion FROM tcadscripciones as ads where p.iid_adscripcion=ads.iid_adscripcion) as adscripcion,
                ed.cdescripcion_estatus_documento,
                pd.cdescripcion_prioridad_documento, ins.cdescripcion_instruccion, s.ccolor_semaforo, d.dfecha_termino, d.casunto, u.name
                FROM gestionom.tadocumentos as d
                join tctipos_documentos as td on d.iid_tipo_documento=td.iid_tipo_documento
                join tctipos_anexos as ta on d.iid_tipo_anexo=ta.iid_tipo_anexo
                join tcpersonal as p on d.iid_personal_remitente=p.iid_personal
                join tcestatus_documentos as ed on d.iid_estatus_documento=ed.iid_estatus_documento
                join tcprioridades_documentos as pd on d.iid_prioridad_documento=pd.iid_prioridad_documento
                join tcinstrucciones as ins on d.iid_instruccion=ins.iid_instruccion
                join tcsemaforo as s on d.iid_semaforo=s.iid_semaforo
                join users as u on d.iid_usuario=u.id
                where d.iestatus=1 
                  and d.iid_documento>=10599";

         * CONSULTA CON DB::select($sql) NO FUNCIONA PORQUE EN EL RESULTADO, AGRUPA TODO EN UNA SOLA COLUMNA Y ASÍ NO LO PUEDE MANEJAR MAATWEBSITE
        $sql = "select d.iid_documento, d.cfolio, d.dfecha_recepcion, d.cnumero_documento, d.dfecha_documento, td.cdescripcion_tipo_documento,
                ta.cdescripcion_tipo_anexo, p.cnombre_personal, p.cpaterno_personal, p.cmaterno_personal,
                ed.cdescripcion_estatus_documento, pd.cdescripcion_prioridad_documento, ins.cdescripcion_instruccion, s.ccolor_semaforo, 
                d.dfecha_termino, d.casunto, u.name
                from tadocumentos as d
                join tctipos_documentos as td on d.iid_tipo_documento=td.iid_tipo_documento
                join tctipos_anexos as ta on d.iid_tipo_anexo=ta.iid_tipo_anexo
                join tcpersonal as p on d.iid_personal_remitente=p.iid_personal
                join tcestatus_documentos as ed on d.iid_estatus_documento=ed.iid_estatus_documento
                join tcprioridades_documentos as pd on d.iid_prioridad_documento=pd.iid_prioridad_documento
                join tcinstrucciones as ins on d.iid_instruccion=ins.iid_instruccion
                join tcsemaforo as s on d.iid_semaforo=s.iid_semaforo
                join users as u on d.iid_usuario=u.id
                where d.iestatus=1 and d.iid_documento>=10599;";
        $documentos = DB::select($sql);
        */
        $documentos = DB::table('tadocumentos as d')
                        ->Join('tctipos_documentos as td',      'd.iid_tipo_documento',     '=','td.iid_tipo_documento')
                        ->Join('tctipos_anexos as ta',          'd.iid_tipo_anexo',         '=','ta.iid_tipo_anexo')
                        ->Join('tcpersonal as p',               'd.iid_personal_remitente', '=','p.iid_personal')
                        ->Join('tcpuestos as pst',              'p.iid_puesto',             '=','pst.iid_puesto')
                        ->Join('tcadscripciones as adsc',       'p.iid_adscripcion',        '=','adsc.iid_adscripcion')
                        ->Join('tcestatus_documentos as ed',    'd.iid_estatus_documento',  '=','ed.iid_estatus_documento')
                        ->Join('tcprioridades_documentos as pd','d.iid_prioridad_documento','=','pd.iid_prioridad_documento')
                        ->Join('tcinstrucciones as ins',        'd.iid_instruccion',        '=','ins.iid_instruccion')
                        ->Join('tcsemaforo as s',               'd.iid_semaforo',           '=','s.iid_semaforo')
                        ->Join('users as u',                    'd.iid_usuario',            '=','u.id')
                        ->select('d.iid_documento','d.cfolio','d.dfecha_recepcion','d.cnumero_documento','d.dfecha_documento','td.cdescripcion_tipo_documento','ta.cdescripcion_tipo_anexo','p.cnombre_personal','p.cpaterno_personal','p.cmaterno_personal','pst.cdescripcion_puesto','adsc.cdescripcion_adscripcion','ed.cdescripcion_estatus_documento','pd.cdescripcion_prioridad_documento','ins.cdescripcion_instruccion','s.ccolor_semaforo','d.dfecha_termino','d.casunto','u.name')
                        ->where('d.iestatus','=',1)->get();
        return $documentos;
    }
}
