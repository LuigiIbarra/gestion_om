<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adscripcion extends Model
{
    use HasFactory;
    protected $table = 'tcadscripciones';
    protected $primaryKey = 'iid_adscripcion';

    public function personal(){
        return $this->belongsTo('App\Models\Catalogos\Personal');
    }

    public function tipoarea(){
        return $this->hasOne('App\Models\Catalogos\TipoArea','iid_tipo_area','iid_tipo_area');
    }

    public function destinatarioatencion(){
        return $this->hasMany('App\Models\Gestion\DestinatarioAtencion','iid_adscripcion','iid_adscripcion');
    }

    public function otrodestinoatencion(){
        return $this->hasMany('App\Models\Gestion\DestinatarioAtencion','iid_adscripcion','iid_otra_adscripcion');
    }

    public function destinatarioconocimiento(){
        return $this->hasMany('App\Models\Gestion\DestinatarioConocimiento','iid_adscripcion','iid_adscripcion');
    }

    public function otrodestinoconocimiento(){
        return $this->hasMany('App\Models\Gestion\DestinatarioConocimiento','iid_adscripcion','iid_otra_adscripcion');
    }
}
