<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportanciaContenido extends Model
{
    use HasFactory;
    protected $table = 'tcimportancia_contenidos';
    protected $primaryKey = 'iid_importancia_contenido';

    public function documento(){
        return $this->hasMany('App\Models\Gestion\Documento','iid_importancia_contenido','iid_importancia_contenido');
    }
}
