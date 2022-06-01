<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    protected $table = 'tcpermisos';
    protected $primaryKey = 'iid_permiso';

    public function permiso_rol(){
        return $this->hasMany('App\Models\Catalogos\PermisoRol','iid_permiso','iid_permiso');
    }
}
