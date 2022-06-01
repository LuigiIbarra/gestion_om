<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisoRol extends Model
{
    use HasFactory;
    protected $table = 'tcpermisos_roles';
    protected $primaryKey = 'iid_permiso_rol';

    public function rol(){
        return $this->hasOne('App\Models\Catalogos\Rol','iid_rol','iid_rol');
    }

    public function permiso(){
        return $this->hasOne('App\Models\Catalogos\Permiso','iid_permiso','iid_permiso');
    }
}
