<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'tcroles';
    protected $primaryKey = 'iid_rol';

    public function usuario(){
        return $this->hasMany('App\Models\User','iid_rol','iid_rol');
    }

    public function permiso_rol(){
        return $this->hasMany('App\Models\Catalogos\PermisoRol','iid_rol','iid_rol');
    }
}
