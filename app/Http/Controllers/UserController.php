<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


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
      
      $Year = date("Y");
      //Validar el formulario
      $data = $request->validate([
        'nombre'=> 'required|min:5|max:255',
        'apellidos'=> 'required|min:5|max:255',
        'edad'=> 'required|integer|min:18|max:100',
        'nacionalidad'=> 'required|min:1|max:255',
        'ci'=> 'required',
        'telefono'=> 'required',
        'email'=> 'required',
        'image_url'=> 'size:1024|image',
        // 'image_url'=> 'file|size:512|image',
        'id_Idioma'=> 'required|not_in:0'
        
      ]);
        
        //Llamado al modelo de traductores para poder guardarlo luego en bd
        $traductor = new Traductores();
        $traductor->nombre = $request->nombre;
        $traductor->apellidos = $request->apellidos;
        $traductor->lugar_Nac = $request->lugar_Nac;
        $traductor->edad = $request->edad;
        $traductor->nacionalidad = $request->nacionalidad;
        $traductor->prof_Ocup = $request->prof_Ocup;
        $traductor->ci = intval($request->ci);
        $traductor->telefono = $request->telefono;
        $traductor->email = $request->email;
        $traductor->image_url = $newFileName;
        $traductor->ant_penales = $newFileNameAntecedentes;
        $traductor->curriculum = $newFileNameCurriculum;
        $traductor->id_Idioma = $request->id_Idioma;
        $traductor->id_Estado = 1;
        $traductor->anno = $Year;
        $traductor->num_Solicitud = $nextSolicitud;
        $traductor->save();
        return redirect('/admin/usuarios')->with('mensaje','Ha creado un usuario correctamente');
       
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
        $trad_id = Traductores::find($traductores);
        //Retornar a la vista
        return view('/traductores/edit',['trad'=>$trad_id]);
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
        'apellidos'=> 'required|min:5|max:255',
        'edad'=> 'required|integer|min:18|max:100',
        'nacionalidad'=> 'required|min:1|max:255',
        'ci'=> 'required',
        'telefono'=> 'required',
        'email'=> 'required',
        'image_url'=> 'size:1024|image',
        // 'image_url'=> 'file|size:512|image',
        'id_Idioma'=> 'required|not_in:0'
        
      ]);

        
      //Llamado al modelo de traductores para poder guardarlo luego n bd
        $traductor = Traductores::findOrFail($traductores);
        
        $traductor->nombre = $request->nombre;
        $traductor->apellidos = $request->apellidos;
        $traductor->lugar_Nac = $request->lugar_Nac;
        $traductor->edad = $request->edad;
        $traductor->nacionalidad = $request->nacionalidad;
        $traductor->prof_Ocup = $request->prof_Ocup;
        $traductor->ci = intval($request->ci);
        $traductor->telefono = $request->telefono;
        $traductor->email = $request->email;
        $traductor->image_url = $newFileName;
        $traductor->ant_penales = $request->ant_penales;
        $traductor->curriculum = $request->curriculum;
        $traductor->id_Idioma = $request->id_Idioma;
        $traductor->ant_penales = $request->ant_penales;
        //dd($traductor);

        $traductor->save();
        return redirect('/traductores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $trad_id = Traductores::find($traductores);
        
        //Borrar el traductor
        $trad_id->delete();
        return redirect('/traductores');
    }
}
