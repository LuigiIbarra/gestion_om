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
}
