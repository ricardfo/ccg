<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculo extends Model
{
    protected $table = 'Curriculos';

    public function disciplinasObrigatorias()
    {
        return $this->hasMany('App\DisciplinasObrigatoria', 'id', 'id_crl');
    }

    public function disciplinasOptativasEletivas()
    {
        return $this->hasMany('App\DisciplinasOptativasEletiva', 'id', 'id_crl');
    }

    public function disciplinasLicenciaturas()
    {
        return $this->hasMany('App\DisciplinasLicenciatura', 'id', 'id_crl');
    }
}
