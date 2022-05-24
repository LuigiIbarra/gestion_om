<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;
    protected $table = 'tctemas';
    protected $primaryKey = 'iid_tema';

    public function documento(){
        return $this->belongsTo('App\Models\Gestion\Documento');
    }
}
