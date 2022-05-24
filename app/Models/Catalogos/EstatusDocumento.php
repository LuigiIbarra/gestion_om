<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstatusDocumento extends Model
{
    use HasFactory;
    protected $table = 'tcestatus_documentos';
    protected $primaryKey = 'iid_estatus_documento';

    public function documento(){
        return $this->belongsTo('App\Models\Gestion\Documento');
    }
}
