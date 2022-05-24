<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $table = 'tcpersonal';
    protected $primaryKey = 'iid_personal';

    public function remitente(){
        return $this->hasMany('App\Models\Gestion\Documento','iid_personal','iid_personal_remitente');
    }

    public function conocimiento(){
        return $this->hasMany('App\Models\Gestion\Documento','iid_personal','iid_personal_conocimiento');
    }
}
