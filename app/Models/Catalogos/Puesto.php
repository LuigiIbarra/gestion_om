<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;
    protected $table = 'tcpuestos';
    protected $primaryKey = 'iid_puesto';

    public function personal(){
        return $this->belongsTo('App\Models\Catalogos\Personal');
    }

    public function otrodestinoatencion(){
        return $this->hasMany('App\Models\Gestion\DestinatarioAtencion','iid_puesto','iid_otro_puesto');
    }

    public function otrodestinoconocimiento(){
        return $this->hasMany('App\Models\Gestion\DestinatarioConocimiento','iid_puesto','iid_otro_puesto');
    }
}
