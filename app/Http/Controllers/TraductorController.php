<?php

namespace App\Http\Controllers;

use App\Traductores;
use Illuminate\Http\Request;

class TraductorController extends Controller
{
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
        $traductor->image_url = '';
        $traductor->ant_penales = $request->ant_penales;
        $traductor->curriculum = $request->curriculum;
        $traductor->id_Idioma = $request->id_Idioma;
        $traductor->ant_penales = $request->ant_penales;
        $traductor->id_Estado = 1;
        $traductor->anno = 2020;
        $traductor->save();
        return redirect('/solicitudes');
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
    public function edit(Traductores $traductores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Traductores  $traductores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Traductores $traductores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Traductores  $traductores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Traductores $traductores)
    {
        //
    }
}
