<?php

namespace App\Http\Controllers;
use App\Solicitudes;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
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

    public function indexSolicitud()
    {
        $soli= Solicitudes::where([
            ['id_Estado', '<>', '5'],
            ['id_Estado', '<>', '6'],
        ])->get();

        return view('solicitudes.solicitudesGeneral', ['soli' => $soli]);
    }

    public function indexSolicitudSuspensas()
    {
         $soliSuspensas = Solicitudes::where('id_Estado',5)
         ->orderBy('nombre','asc')
         ->get();
        return view('solicitudes.solicitudesSuspensas', ['soliSuspensas' => $soliSuspensas]);

    }

    public function indexSolicitudRegistro()
    {
        return view('solicitudes.solicitudesRegistro');
    }
}
