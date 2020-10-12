<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'tbSolicitudesAdminsion';
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
}
