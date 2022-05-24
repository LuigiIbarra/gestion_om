<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinatarioAtencion extends Model
{
    use HasFactory;
    protected $table = 'tadestinatarios_atencion';
    protected $primaryKey = 'iid_destinatario_atencion';

    public function documento(){
        return $this->hasOne('App\Models\Gestion\Documento','iid_documento','iid_documento');
    }

    public function adscripcion(){
        return $this->hasOne('App\Models\Catalogos\Adscripcion','iid_adscripcion','iid_adscripcion');
    }
}
