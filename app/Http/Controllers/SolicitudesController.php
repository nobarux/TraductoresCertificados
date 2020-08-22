<?php

namespace App\Http\Controllers;
use App\Solicitudes;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
{
    public function indexSolicitud()
    {
        $soli= Solicitudes::where([
            ['id_Estado', '<>', '5'],
            ['id_Estado', '<>', '6'],
        ])->get();

        return view('/solicitudesGeneral', ['soli' => $soli]);
    }

    public function indexSolicitudSuspensas()
    {
         $soliSuspensas = Solicitudes::where('id_Estado',5)
         ->orderBy('nombre','asc')
         ->get();
        return view('/solicitudesSuspensas', ['soliSuspensas' => $soliSuspensas]);

    }
}
