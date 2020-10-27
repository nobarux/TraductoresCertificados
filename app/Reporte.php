<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'solicituds';
    public $primaryKey = 'id';

     /**Esta funcion es para q el formato de salida de los datos tipo datetime sean Año mes y dia */
     protected $dateFormat = 'Ymd H:m:s';

     /*Funcion para la relacion entren solicitud e idiomas*/ 
     public function idioma()
     {
         return $this->belongsTo('App\Idiomas','id_Idioma');
     }
     
      /**/ 
      public function provincia()
      {
          return $this->belongsTo('App\Provincia','id_Prov');
      }

      public function estado()
      {
          return $this->belongsTo('App\Estado','id_Estados');
      }

      public function listaidiomas($idIdioma)
      {
        $listaidioma = Idioma::where('id_Idioma', $idIdioma)->first();
       return $listaidioma->nombre;
      }

      public function listaprovincias($idProvincia)
      {
        $listaprov = Provincia::where('dpa', $idProvincia)->first();
       return $listaprov->nombre;
      }

      public function listaprofesion($idProfesion)
      {
        $listaprof = Profesion::where('id_Prof', $idProfesion)->first();
       return $listaprof->nombre;
      }
}
