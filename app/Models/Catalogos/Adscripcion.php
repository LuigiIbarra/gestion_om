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

    public function destinatarioatencion(){
        return $this->hasMany('App\Models\Gestion\DestinatarioAtencion','iid_adscripcion','iid_adscripcion');
    }

    public function destinatarioconocimiento(){
        return $this->hasMany('App\Models\Gestion\DestinatarioConocimiento','iid_adscripcion','iid_adscripcion');
    }
}
