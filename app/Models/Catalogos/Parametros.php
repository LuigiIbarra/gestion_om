<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametros extends Model
{
    use HasFactory;
    protected $table = 'parametros';
    protected $primaryKey = 'iid_parametro';
}
