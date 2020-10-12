<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'nProvincias';
     /**Esta funcion es para q el formato de salida de los datos tipo datetime sean Año mes y dia */
     protected $dateFormat = 'Ymd H:m:s';
}
