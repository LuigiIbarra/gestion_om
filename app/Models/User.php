<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Catalogos\Permiso;
use App\Models\Catalogos\PermisoRol;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rol(){
        return $this->hasOne('App\Models\Catalogos\Rol','iid_rol','iid_rol');
    }

    public function verificaPermiso($permiso){
        //USANDO tablas Roles, Permisos y PermisosRol
        $id_rol       = Auth()->user()->iid_rol;
        $id_permiso   = Permiso::where('cnombre_permiso','=',$permiso)->first();
        $siHayPermiso = PermisoRol::where('iid_rol','=',$id_rol)->where('iid_permiso','=',$id_permiso->iid_permiso)->first();
        if ($siHayPermiso != null)
            return (boolean) $siHayPermiso->ipermiso; 
        return false;//"permiso no identificado.";
    }
}
