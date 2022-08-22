<?php

namespace App\Models\Gestion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolioRelacionado extends Model
{
    use HasFactory;
    protected $table = 'tafolios_relacionados';
    protected $primaryKey = 'iid_folio_relacionado';

    public function documento(){
        return $this->hasOne('App\Models\Gestion\Documento','iid_documento','iid_documento');
    }
}
