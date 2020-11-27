<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    protected $table = "permisos";
    public $primaryKey = "id";

    public function roles()
    {
        return $this->belongsToMany('App\Roles', 'roles_permisos');
    }
}
