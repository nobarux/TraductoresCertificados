<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = "solicituds";
    public $primaryKey = "id";

    public function idioma()
     {
         return $this->belongsTo('App\Idiomas','id_Idioma');
     }
}
