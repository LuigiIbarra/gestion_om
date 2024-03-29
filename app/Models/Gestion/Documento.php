<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    protected $table = 'tadocumentos';
    protected $primaryKey = 'iid_documento';

    public function tipodocumento(){
        return $this->hasOne('App\Models\Catalogos\TipoDocumento','iid_tipo_documento','iid_tipo_documento');
    }

    public function tipoanexo(){
        return $this->hasOne('App\Models\Catalogos\TipoAnexo','iid_tipo_anexo','iid_tipo_anexo');
    }

    public function estatusdocumento(){
        return $this->hasOne('App\Models\Catalogos\EstatusDocumento','iid_estatus_documento','iid_estatus_documento');
    }

    public function prioridaddocumento(){
        return $this->hasOne('App\Models\Catalogos\PrioridadDocumento','iid_prioridad_documento','iid_prioridad_documento');
    }

    public function semaforodocumento(){
        return $this->hasOne('App\Models\Catalogos\Semaforo','iid_semaforo','iid_semaforo');
    }

    public function importanciacontenido(){
        return $this->hasOne('App\Models\Catalogos\ImportanciaContenido','iid_importancia_contenido','iid_importancia_contenido');
    }

    public function tema(){
        return $this->hasOne('App\Models\Catalogos\Tema','iid_tema','iid_tema');
    }

    public function tipoasunto(){
        return $this->hasOne('App\Models\Catalogos\TipoAsunto','iid_tipo_asunto','iid_tipo_asunto');
    }

    public function instruccion(){
        return $this->hasOne('App\Models\Catalogos\Instruccion','iid_instruccion','iid_instruccion');
    }

    public function personalremitente(){
        return $this->hasOne('App\Models\Catalogos\Personal','iid_personal','iid_personal_remitente');
    }

    public function personalconocimiento(){
        return $this->hasMany('App\Models\Gestion\PersonalConocimiento','iid_documento','iid_documento');
    }

    public function destinatarioatencion(){
        return $this->hasMany('App\Models\Gestion\DestinatarioAtencion','iid_documento','iid_documento');
    }

    public function destinatarioconocimiento(){
        return $this->hasMany('App\Models\Gestion\DestinatarioConocimiento','iid_documento','iid_documento');
    }

    public function foliorelacionado(){
        return $this->hasMany('App\Models\Gestion\FolioRelacionado','iid_documento','iid_documento');
    }
}
