<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinatarioConocimiento extends Model
{
    use HasFactory;
    protected $table = 'tadestinatarios_conocimiento';
    protected $primaryKey = 'iid_destinatario_conocimiento';

    public function documento(){
        return $this->hasOne('App\Models\Gestion\Documento','iid_documento','iid_documento');
    }

    public function adscripcion(){
        return $this->hasOne('App\Models\Catalogos\Adscripcion','iid_adscripcion','iid_adscripcion');
    }

    public function otraadscripcion(){
        return $this->hasOne('App\Models\Catalogos\Adscripcion','iid_otra_adscripcion','iid_adscripcion');
    }

    public function tipodocumento(){
        return $this->hasOne('App\Models\Catalogos\TipoDocumento','iid_tipo_documento','iid_tipo_documento');
    }

    public function estatusdocumento(){
        return $this->hasOne('App\Models\Catalogos\EstatusDocumento','iid_estatus_documento','iid_estatus_documento');
    }
}
