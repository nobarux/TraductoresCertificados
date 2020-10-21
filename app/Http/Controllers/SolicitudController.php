<?php

namespace App\Http\Controllers;

use App\Idioma;
use App\Solicitud;
use App\Estado;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soli = Solicitud::all();
        
        $idIdioma = $soli[0]->idioma;
        $idEstado = $soli[0]->estado;
        $idioma = Idioma::where('id_Idioma', $idIdioma)->get();
        $estado = Estado::where('id_Estados', $idEstado)->get();
        return view('/solicitudes/solicitudesGeneral', ['soli' => $soli, 'idioma' => $idioma, 'estado' => $estado]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entity = new Solicitud();
        $entity->nombre = $request->nombre;
        $entity->apellidos = $request->apellidos;
        $entity->carnet = $request->carnet;
        $entity->profesion = $request->profesion;
        $entity->sexo = $request->sexo;
        $entity->direccion = $request->direccion;
        $entity->provincia = $request->provincia;
        $entity->municipio = $request->municipio;
        $entity->telefono_fijo = $request->telefono_fijo;
        $entity->telefono_celular = $request->telefono_celular;
        $entity->email = $request->email;
        $entity->idioma = $request->idioma;
        $entity->certificacion = $request->certificacion;

        $archivos = [
            'archivo_foto' => "ap",
            'archivo_carnet_alante' => "cal",
            'archivo_carnet_atras' => "cat",
            'archivo_titulo_univ' => "univ",
            'archivo_antecedentes' => "ant"
        ];
        $entity->file_foto = $this->uploadFile($request->file('archivo_foto'), $entity->carnet.'/'.$archivos['archivo_foto']);
        $entity->file_carnet1 = $this->uploadFile($request->file('archivo_carnet_alante'), $entity->carnet.'/'.$archivos['archivo_carnet_alante']);
        $entity->file_carnet2 = $this->uploadFile($request->file('archivo_carnet_atras'), $entity->carnet.'/'.$archivos['archivo_carnet_atras']);
        $entity->file_titulo = $this->uploadFile($request->file('archivo_titulo_univ'), $entity->carnet.'/'.$archivos['archivo_titulo_univ']);
        $entity->file_antecedentes = $this->uploadFile($request->file('archivo_antecedentes'), $entity->carnet.'/'.$archivos['archivo_antecedentes']);

        $entity->save();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Certificacion\Solicitud $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Certificacion\Solicitud $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Certificacion\Solicitud $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }


    //////////////////////////////////////////////METODOS AUXILIARES/////////////////////////////////////////

    public function aprobadosUpdate(Request $request, $solicitudes)
    {
        // dd('Esto es una prueba');
        // return view('solicitudes.solicitudesRegistro');
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitud::findOrFail($solicitudes);
        $solicitud->id_Estado = 2;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/solicitudes');
    }

    public function pendienteCalifUpdate(Request $request, $solicitudes)
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitud::findOrFail($solicitudes);
        $solicitud->id_Estado = 3;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/solicitudes');
    }

    public function aprobUpdate(Request $request, $solicitudes)
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitud::findOrFail($solicitudes);
        $solicitud->id_Estado = 4;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/solicitudes');
    }

    public function suspUpdate(Request $request, $solicitudes)
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitud::findOrFail($solicitudes);
        $solicitud->id_Estado = 5;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/solicitudes');
    }

    public function reclamarUpdate(Request $request, $solicitudes)
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitud::findOrFail($solicitudes);
        $solicitud->estado = 6;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/solicitudes/solicitudesSuspensas');
    }

   
    public function indexSolicitudSuspensas()
    {
         
         $soliSuspensas = Solicitud::where('estado',5)
         ->orderBy('nombre','asc')
         ->get();
         $idIdioma = $soliSuspensas[0]->idioma;
         $idEstado = $soliSuspensas[0]->estado;
         $idioma = Idioma::where('id_Idioma', $idIdioma)->get();
         $estado = Estado::where('id_Estados', $idEstado)->get();
        return view('/solicitudes/solicitudesSuspensas', ['soliSuspensas' => $soliSuspensas,'idioma' => $idioma , 'estado'=>$estado]);

    }
}
