<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {

        $usuarios = User::all();

        return view('admin.usuarios', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $roles = Role::all();
      dd($roles);

        return view('admin.usuarios.create',['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //Validar el formulario
       $data = $request->validate([
        'nombre'=> 'required|min:5|max:255',
        'email'=> 'required|unique:users|email',
        'password'=> 'required|between:8,255|confirmed',
        'password_confirmation'=> 'required'
        
      ]);
        //Llamado al modelo de traductores para poder guardarlo luego en bd
        $user = new User();
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->password = $request->password;
        if ($request->password != null) {
          $user->password = Hash::make($request->password);
        }
        
        $user->save();
        
        return redirect('/usuarios')->with('mensaje','Ha creado un usuario correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        //Variable q captura la id del traductor para editarlo
        $user_id = User::find($user);
        //Retornar a la vista
        return view('admin/usuarios/edit',['user'=>$user_id]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        //Validar el formulario
      $data = $request->validate([
        'nombre'=> 'required|min:5|max:255',
        'email'=> 'required|unique:users|email',
        'password'=> 'required|between:8,255|confirmed',
        'password_confirmation'=> 'required'

        
      ]);

        
      //Llamado al modelo de traductores para poder guardarlo luego n bd
        $user = User::findOrFail($user);
        
        $user->name = $request->nombre;
        $user->email = $request->email;
        if ($request->password != null) {
          $user->password = Hash::make($request->password);
        }
        
        $user->save();
        return redirect('/usuarios')->with('mensaje','Ha actualizado un usuario correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user_id = User::find($user);
        //Borrar el traductor
        $user_id->delete();
        return redirect('/usuarios')->with('mensaje','Ha eliminado un usuario correctamente');
    }
}
