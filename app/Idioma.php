<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    protected $table = "idioma";
    public $primaryKey = "id_Idioma";
    
    public function reporte()
    {
        return $this->hasOne('App\Reporte');
    }
}