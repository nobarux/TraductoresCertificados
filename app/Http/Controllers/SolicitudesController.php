<?php

namespace App\Http\Controllers;
use App\Solicitudes;
use App\Idiomas;
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
        $idiomas = Idiomas::all();

        return view('solicitudes.solicitudesRegistro', ['idioma' => $idiomas]);
    }

    public function aprobadosUpdate(Request $request, $solicitudes)
    {
        //
        $solicitud = Solicitudes::findOrFail($solicitudes);
        $solicitud->id_Estado = 2;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/solicitudes');
    }

    public function pendienteCalifUpdate(Request $request, $solicitudes)
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitudes::findOrFail($solicitudes);
        $solicitud->id_Estado = 3;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/solicitudes');
    }

    public function aprobUpdate(Request $request, $solicitudes)
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitudes::findOrFail($solicitudes);
        $solicitud->id_Estado = 4;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/solicitudes');
    }

    public function suspUpdate(Request $request, $solicitudes)
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitudes::findOrFail($solicitudes);
        $solicitud->id_Estado = 5;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/solicitudes');
    }

    public function reclamarUpdate(Request $request, $solicitudesSus)
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitudes::findOrFail($solicitudesSus);
        $solicitud->id_Estado = 6;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/reclamaciones');
    }

}
