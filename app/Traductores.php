<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traductores extends Model
{
    protected $table = 'tbSolicitudesAdminsion';
    public $primaryKey = 'id';

    /**Esta funcion es para q el formato de salida de los datos tipo datetime sean Año mes y dia */
    protected $dateFormat = 'Ymd H:m:s';
    
}
