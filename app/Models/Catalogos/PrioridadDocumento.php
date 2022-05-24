<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrioridadDocumento extends Model
{
    use HasFactory;
    protected $table = 'tcprioridades_documentos';
    protected $primaryKey = 'iid_prioridad_documento';

    public function documento(){
        return $this->belongsTo('App\Models\Gestion\Documento');
    }
}
