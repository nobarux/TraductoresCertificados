<?php

namespace App\Http\Controllers;

use App\User;
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
        $idiomas = Idiomas::all();
        return view('solicitudes.solicitudesRegistro',['idioma' => $idiomas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
      // $Year = date("Y");
      // //Validar el formulario
      // $data = $request->validate([
      //   'nombre'=> 'required|min:5|max:255',
      //   'apellidos'=> 'required|min:5|max:255',
      //   'edad'=> 'required|integer|min:18|max:100',
      //   'nacionalidad'=> 'required|min:1|max:255',
      //   'ci'=> 'required',
      //   'telefono'=> 'required',
      //   'email'=> 'required',
      //   'image_url'=> 'size:1024|image',
      //   // 'image_url'=> 'file|size:512|image',
      //   'id_Idioma'=> 'required|not_in:0'
        
      // ]);
        
      //   //Llamado al modelo de traductores para poder guardarlo luego en bd
      //   $traductor = new Traductores();
      //   $traductor->nombre = $request->nombre;
      //   $traductor->apellidos = $request->apellidos;
      //   $traductor->lugar_Nac = $request->lugar_Nac;
      //   $traductor->edad = $request->edad;
      //   $traductor->nacionalidad = $request->nacionalidad;
      //   $traductor->prof_Ocup = $request->prof_Ocup;
      //   $traductor->ci = intval($request->ci);
      //   $traductor->telefono = $request->telefono;
      //   $traductor->email = $request->email;
      //   $traductor->image_url = $newFileName;
      //   $traductor->ant_penales = $newFileNameAntecedentes;
      //   $traductor->curriculum = $newFileNameCurriculum;
      //   $traductor->id_Idioma = $request->id_Idioma;
      //   $traductor->id_Estado = 1;
      //   $traductor->anno = $Year;
      //   $traductor->num_Solicitud = $nextSolicitud;
      //   $traductor->save();
      //   return redirect('/admin/usuarios')->with('mensaje','Ha creado un usuario correctamente');
       
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
        'email'=> 'required|min:5|max:255',
        
      ]);

        
      //Llamado al modelo de traductores para poder guardarlo luego n bd
        $user = User::findOrFail($user);
        
        $user->name = $request->nombre;
        $user->email = $request->email;
        if ($request->password != null) {
          $user->password = Hash::make($request->password);
        }
        // $user->lugar_Nac = $request->lugar_Nac;
        
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
