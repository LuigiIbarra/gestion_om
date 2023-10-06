<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semaforo extends Model
{
    use HasFactory;
    protected $table = 'tcsemaforo';
    protected $primaryKey = 'iid_semaforo';

    public function documento(){
        return $this->belongsTo('App\Models\Gestion\Documento');
    }
}
