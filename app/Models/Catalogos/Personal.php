<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $table = 'tcpersonal';
    protected $primaryKey = 'iid_personal';

    public function puesto() {
        return $this->hasOne('App\Models\Catalogos\Puesto','iid_puesto','iid_puesto');
    }

    public function adscripcion() {
        return $this->hasOne('App\Models\Catalogos\Adscripcion','iid_adscripcion','iid_adscripcion');
    }
    
    public function remitente(){
        return $this->hasMany('App\Models\Gestion\Documento','iid_personal_remitente','iid_personal');
    }

    public function personalconocimiento(){
        return $this->hasMany('App\Models\Gestion\PersonalConocimiento','iid_personal','iid_personal');
    }

    public function otrodestinoatencion(){
        return $this->hasMany('App\Models\Gestion\DestinatarioAtencion','iid_personal','iid_otro_personal');
    }

    public function otrodestinoconocimiento(){
        return $this->hasMany('App\Models\Gestion\DestinatarioConocimiento','iid_personal','iid_otro_personal');
    }
}
