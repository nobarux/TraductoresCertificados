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
        //
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
