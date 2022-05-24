<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruccion extends Model
{
    use HasFactory;
    protected $table = 'tcinstrucciones';
    protected $primaryKey = 'iid_instruccion';

    public function documento(){
        return $this->belongsTo('App\Models\Gestion\Documento');
    }
}
