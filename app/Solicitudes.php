<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    protected $table = 'tbSolicitudesAdminsion';
    
     /**Esta funcion es para q el formato de salida de los datos tipo datetime sean Año mes y dia */
     protected $dateFormat = 'Ymd H:m:s';

     /*Funcion para la relacion entren soicitud y estado de la solicitud*/ 
     public function estado()
     {
         return $this->belongsTo('App\Estado','id_Estado');
     }

     /*Funcion para la relacion entren solicitud e idiomas*/ 
     public function idioma()
     {
         return $this->belongsTo('App\Idiomas','id_Idioma');
     }
}
