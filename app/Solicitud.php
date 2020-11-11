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

     public function listaidiomas($idIdioma)
      {
        $listaidioma = Idioma::where('id_Idioma', $idIdioma)->first();
       return $listaidioma->nombre;
      }

      public function listaestados($idEstado)
      {
        $listaestados = Estado::where('id_Estados', $idEstado)->first();
       return $listaestados->nombre;
      }

      public function listaprovincias($idProvincia)
      {
        $listaprov = Provincia::where('dpa', $idProvincia)->first();
       return $listaprov->nombre;
      }

}
