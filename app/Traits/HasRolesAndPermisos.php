<?php
namespace App\Traits;
use App\Role;
use App\Permisos;
/**
 * 
 */
trait HasRolesAndPermisos
{
    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    /**
     * @return mixed
     */
    public function permisos()
    {
        return $this->belongsToMany(Permisos::class, 'user_permisos');
    }

}
 
