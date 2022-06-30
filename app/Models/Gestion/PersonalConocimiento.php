<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalConocimiento extends Model
{
    use HasFactory;
    protected $table = 'tapersonal_conocimiento';
    protected $primaryKey = 'iid_personal_conocimiento';

    public function documento(){
        return $this->hasOne('App\Models\Gestion\Documento','iid_documento','iid_documento');
    }

    public function personal(){
        return $this->hasOne('App\Models\Catalogos\Personal','iid_personal','iid_personal');
    }

    public function tipodocumento(){
        return $this->hasOne('App\Models\Catalogos\TipoDocumento','iid_tipo_documento','iid_tipo_documento');
    }

    public function estatusdocumento(){
        return $this->hasOne('App\Models\Catalogos\EstatusDocumento','iid_estatus_documento','iid_estatus_documento');
    }
}
