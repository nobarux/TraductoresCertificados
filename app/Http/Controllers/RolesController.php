<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permisos;
use App\RolePermisos;
use DB;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id','desc')->get();
        return view('admin.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_nombre' => 'required|max:255',
            'role_slug' => 'required|max:255'
        ]);
        $role = new Role;
        $role->nombre = $request->role_nombre;
        $role->slug = $request->role_slug;
        $role->save();
        $listaPermisos = explode(',',$request->role_permisos);
        // dd($listaPermisos);

        foreach($listaPermisos as $listapermisos)
        {
            $permisos = new Permisos;
            $permisos->nombre = $listapermisos;
            $permisos->slug = strtolower(str_replace(" ","-",$listapermisos));
            $permisos->save();
            $role->permisos()->attach($permisos->id);
            $role->save();
        }

        return redirect('/roles')->with('mensaje','Ha creado el rol correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.roles.show',['role'=> $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($role)
    {
       //Variable q captura la id del traductor para editarlo
       $role_id = Role::find($role);
    //    dd($role_id);

       //Retornar a la vista
       return view('admin/roles/edit',['roles'=>$role_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //Validacion de los campos de updatear roles

        $request->validate([
            'role_nombre' => 'required|max:255',
            'role_slug' => 'required|max:255'
        ]);
        $role->nombre = $request->role_nombre;
        $role->slug = $request->role_slug;
        // dd($role);
        $role->save();

        //DB::table('roles_permisos')->where('role_id', $role->id)->delete();
        //$role->permisos()->detach();
        
         $role->permisos()->delete();
         $role->permisos()->detach();

        $listaPermisos = explode(',',$request->role_permisos);
        // dd($listaPermisos);

        foreach($listaPermisos as $listapermisos)
        {
            $permisos = new Permisos;
            $permisos->nombre = $listapermisos;
            $permisos->slug = strtolower(str_replace(" ","-",$listapermisos));
            // $perms = RolePermisos::where('role_id','=',$role->id)->get();
            $permisos->save();

            $role->permisos()->attach($permisos->id);
            $role->save();
        }
        return redirect('/roles')->with('mensaje','Ha actualizado el rol correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //Borra los permisos del rol mandado
        // $role->permisos()->delete();

        //Borrar el rol
        $role->delete();
        //Borra en la tabla rolespermisos la union entre el rol borrado y el permiso
        $role->permisos()->detach();
        return redirect('/roles')->with('mensaje','Ha eliminado el rol correctamente');
    }
}
