<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAnexo extends Model
{
    use HasFactory;
    protected $table = 'tctipos_anexos';
    protected $primaryKey = 'iid_tipo_anexo';

    public function documento(){
        return $this->belongsTo('App\Models\Gestion\Documento');
    }
}
