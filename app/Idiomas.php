<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idiomas extends Model
{
    protected $table = 'nIdiomas';
     /**Esta funcion es para q el formato de salida de los datos tipo datetime sean Año mes y dia */
     protected $dateFormat = 'Ymd H:m:s';
}
