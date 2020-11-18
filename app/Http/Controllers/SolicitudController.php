<?php

namespace App\Http\Controllers;

use App\Idioma;
use App\Solicitud;
use App\Estado;
use App\Razones;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Storage;
use App\Mail\Error;
use Response;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $razon = Razones::all();
        // dd($razon);
        $soli= Solicitud::where([
            ['estado', '<>', '5'],
            ['estado', '<>', '6'],
            ['estado', '<>', '7'],
            ['estado', '<>', '8']
        ])->get();
        // dd($soli);
        return view('/solicitudes/solicitudesGeneral', ['soli' => $soli], ['razon' => $razon]);
        
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
        
    }


    //////////////////////////////////////////////METODOS AUXILIARES/////////////////////////////////////////

    public function aprobadosInscripcion(Request $request, $solicitudes)
    {
        // return view('solicitudes.solicitudesRegistro');
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitud::findOrFail($solicitudes);
        $solicitud->estado = 2;
        //Este numero de referencia lo voy a generar aleatorio hasta q me den el formato del numero de referencia de cada user
        $random = rand(5, 15);
        $dirUrl = "http://beta.esti.cu/pagos/certificacion/";
        $getHash = $solicitud->hashSeguridad;
        $dirCompleta = $dirUrl . $getHash;
        Mail::to('danilo.arrieta@esti.cu')->queue(new Error("Llego el correo"));
        // dd($dirCompleta);
        $solicitud->referencia = $random;
        //dd($traductor);
        $solicitud->save();
        return redirect('/solicitudes')->with('mensaje','Se ha aprobado la solicitud correctamente');;
    }



    public function pendienteCalifUpdate(Request $request, $solicitudes)
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitud::findOrFail($solicitudes);
        $solicitud->estado = 3;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/solicitudes');
    }

    public function aprobUpdate(Request $request, $solicitudes)
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitud::findOrFail($solicitudes);
        $solicitud->estado = 4;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/solicitudes');
    }

    public function suspUpdate(Request $request, $solicitudes)
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitud::findOrFail($solicitudes);
        $solicitud->estado = 5;
        //dd($traductor);

        $solicitud->save();
        return redirect('/solicitudes');
    }

    public function inscripcionDeneg(Request $request, $solicitudes )
    {   
        // dd($request->all());
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitud::findOrFail($solicitudes);
        $solicitud->estado = 8;
        $solicitud->razones = $request->id_Razones;
        $solicitud->razonesDenegar = $request->razon;
      
        $solicitud->save();
        return redirect('/solicitudes')->with('mensaje','Ha denegado una inscipción correctamente');
    }

    public function reclamarUpdate(Request $request, $solicitudes)
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitud::findOrFail($solicitudes);
        $solicitud->estado = 6;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/solicitudesSuspensas');
    }

    public function reclamarRechazado(Request $request, $solicitudes)
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitud::findOrFail($solicitudes);
        $solicitud->estado = 7;
        //dd($traductor);

        $solicitud->save();
        //return redirect('/solicitudes/solicitudesGeneral');
        return redirect('/reclamaciones');
    }

   
    public function indexSolicitudSuspensas()
    {
         $soliSuspensas = Solicitud::where('estado',5)
         ->orderBy('nombre','asc')
         ->get();
        //  $idIdioma = $soliSuspensas[0]->idioma;
        //  $idEstado = $soliSuspensas[0]->estado;
        //  $idioma = Idioma::where('id_Idioma', $idIdioma)->get();
        //  $estado = Estado::where('estados', $idEstado)->get();
        return view('/solicitudes/solicitudesSuspensas', ['soliSuspensas' => $soliSuspensas])->with('mensaje','Se ha editado el estado de la solicitud a Reclamación');

    }

    public function indexSolicitudReclamar()
    {
         $soliReclamada = Solicitud::where('estado',6)
         ->orderBy('nombre','asc')
         ->get();
        
        return view('/reclamaciones', ['soliReclamada' => $soliReclamada])->with('mensaje','Se ha editado el estado de la solicitud');

    }

    public function foto($solicitudes)
    {
        $fotoUser = Solicitud::where('id', $solicitudes)->firstOrFail();
        $rutaFotoBD = $fotoUser->file_foto;
        // dd($rutaFotoBD);
        $rutaCambiada = str_replace("D:\\","\\\\10.10.10.11\\",$rutaFotoBD);
        // $file_path = "/Apps/certificacion/91022322500/foto.png";
        //$file = Storage::disk('ftp')->download($file_path);
        // Storage::disk('ftp')->files($this->filePath.$filename);
        // $datafile = file_get_contents("smb://INTERNAL;desarrollador1:desarollador*2020@10.10.10.11/Apps/certificacion/91022322500/foto.png");
        // dd($datafile);

        return Response::download($rutaCambiada);
    }

    public function carnet1($solicitudes)
    {
        $anversoUser = Solicitud::where('id', $solicitudes)->firstOrFail();
        // dd($anversoUser);
        $rutaFotoBD = $anversoUser->file_carnet1;
        $rutaCambiada = str_replace("D:\\","\\\\10.10.10.11\\",$rutaFotoBD);

        // dd($ruta);
        return Response::download($rutaCambiada);
    }

    public function carnet2($solicitudes)
    {
        $reversoUser = Solicitud::where('id', $solicitudes)->firstOrFail();
        //dd($fotoUser);
        $rutaFotoBD = $reversoUser->file_carnet2;
        $rutaCambiada = str_replace("D:\\","\\\\10.10.10.11\\",$rutaFotoBD);
        return Response::download($rutaCambiada);
    }

    public function tit($solicitudes)
    {
        $titUser = Solicitud::where('id', $solicitudes)->firstOrFail();
        //dd($fotoUser);
        $rutaFotoBD = $titUser->file_titulo;
        $rutaCambiada = str_replace("D:\\","\\\\10.10.10.11\\",$rutaFotoBD);
        return Response::download($rutaCambiada);
    }

    public function ante($solicitudes)
    {
        $anteUser = Solicitud::where('id', $solicitudes)->firstOrFail();
        //dd($fotoUser);
        $rutaFotoBD = $anteUser->file_antecedentes;
        $rutaCambiada = str_replace("D:\\","\\\\10.10.10.11\\",$rutaFotoBD);
        return Response::download($rutaCambiada);
    }
}
