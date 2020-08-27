<?php

namespace App\Http\Controllers;

use App\Traductores;
use Illuminate\Http\Request;

class TraductorController extends Controller
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

        $trad = Traductores::all();

        return view('traductores.index', ['trad' => $trad]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('solicitudes.solicitudesRegistro');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //dd($request); //Esto creo q es un var dump

      //Validar el formulario
      $data = $request->validate([
        'nombre'=> 'required|min:5|max:255',
        'apellidos'=> 'required|min:5|max:255',
        'edad'=> 'required|integer|min:18|max:100',
        'nacionalidad'=> 'required|min:1|max:255',
        'ci'=> 'required',
        'telefono'=> 'required',
        'email'=> 'required',
        'image_url'=> 'image',
        // 'image_url'=> 'file|size:512|image',
        'id_Idioma'=> 'required|not_in:0'
        
      ]);


        // Obtener los archivos del formulario
        $fileNameWithTheExtension = request('image_url')->getClientOriginalName();
        
        //Obtener el nombre del archivo
        $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
        
        //Obtener la extenion del archivo a guardar
        $extension = request('image_url')->getClientOriginalExtension();

        //Creacion de un nombr nuevo para guaradarlo en bd
        $newFileName = $fileName . '_' . time() . '.' . $extension;

        //Redirigir las imagenes para una carpeta publica
        $path = request('image_url')->storeAs('public/imagenesTraductores',$newFileName);

        
      //Llamado al modelo de traductores para poder guardarlo luego n bd
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
        $traductor->ant_penales = $request->ant_penales;
        $traductor->curriculum = $request->curriculum;
        $traductor->id_Idioma = $request->id_Idioma;
        $traductor->ant_penales = $request->ant_penales;
        $traductor->id_Estado = 1;
        $traductor->anno = 2020;
        $traductor->save();
        return redirect('/traductores');
        //   dd($id_Idioma);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Traductores  $traductores
     * @return \Illuminate\Http\Response
     */
    public function show(Traductores $traductores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Traductores  $traductores
     * @return \Illuminate\Http\Response
     */
    public function edit($traductores)
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
     * @param  \App\Traductores  $traductores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $traductores)
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
        'image_url'=> 'image',
        // 'image_url'=> 'file|size:512|image',
        'id_Idioma'=> 'required|not_in:0'
        
      ]);


        // Obtener los archivos del formulario
        $fileNameWithTheExtension = request('image_url')->getClientOriginalName();
        
        //Obtener el nombre del archivo
        $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
        
        //Obtener la extenion del archivo a guardar
        $extension = request('image_url')->getClientOriginalExtension();

        //Creacion de un nombr nuevo para guaradarlo en bd
        $newFileName = $fileName . '_' . time() . '.' . $extension;

        //Redirigir las imagenes para una carpeta publica
        $path = request('image_url')->storeAs('public/imagenesTraductores',$newFileName);

        
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
        $traductor->anno = 2020;
        //dd($traductor);

        $traductor->save();
        return redirect('/traductores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Traductores  $traductores
     * @return \Illuminate\Http\Response
     */
    public function destroy($traductores)
    {
        $trad_id = Traductores::find($traductores);
        //Borrar el traductor
        $trad_id->delete();
        return redirect('/traductores');
    }
}
