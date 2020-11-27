<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";
    public $primaryKey = "id";

    public function permisos()
    {
        return $this->belongsToMany('App\Permisos', 'roles_permisos');
    }
}
