<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;
    protected $table = 'tctipos_documentos';
    protected $primaryKey = 'iid_tipo_documento';

    public function documento(){
        return $this->belongsTo('App\Models\Gestion\Documento');
    }

    public function destinatarioatencion(){
        return $this->hasMany('App\Models\Gestion\DestinatarioAtencion','iid_tipo_documento','iid_tipo_documento');
    }

    public function destinatarioconocimiento(){
        return $this->hasMany('App\Models\Gestion\DestinatarioConocimiento','iid_tipo_documento','iid_tipo_documento');
    }

    public function personalconocimiento(){
        return $this->hasMany('App\Models\Gestion\PersonalConocimiento','iid_tipo_documento','iid_tipo_documento');
    }
}
