<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAsunto extends Model
{
    use HasFactory;
    protected $table = 'tctipos_asuntos';
    protected $primaryKey = 'iid_tipo_asunto';

    public function documento(){
        return $this->belongsTo('App\Models\Gestion\Documento');
    }
}
