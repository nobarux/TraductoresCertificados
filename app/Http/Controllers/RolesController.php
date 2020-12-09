<?php

namespace App\Http\Controllers;

use App\Role;
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
        // dd($request);
        $request->validate([
            'role_nombre' => 'required|max:255',
            'role_slug' => 'required|max:255'
        ]);
        $role = new Role;
        $role->nombre = $request->role_nombre;
        $role->slug = $request->role_slug;
        $role->save();
        return redirect('/roles')->with('mensaje','Ha eliminad el rol correctamente');
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
        // dd($request); 
        $role->nombre = $request->role_nombre;
        $role->slug = $request->role_slug;
        $role->save();
        return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //Borrar el traductor
        $role->delete();
        return redirect('/roles')->with('mensaje','Ha eliminad el rol correctamente');
    }
}
