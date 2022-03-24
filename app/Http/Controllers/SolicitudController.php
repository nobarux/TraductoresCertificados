<?php

namespace App\Http\Controllers;

use App\Idioma;
use App\Solicitud;
use App\Estado;
use App\Razones;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\MensajeRecibido;
use App\Mail\MensajeInscripcionCancelacion;
use App\Mail\Error;
use Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

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
        // $soli= Solicitud::where([
        //     ['estado', '<>', '5'],
        //     ['estado', '<>', '6'],
        //     ['estado', '<>', '7'],
        //     ['estado', '<>', '8']
        // ])->orderBy('id')->paginate(25);
        $soli = Solicitud::select(['id', 'nombre', 'apellidos','carnet','email',
        'certificacion','sexo','telefono_fijo','telefono_celular','idioma','colorP',
        'profesion','provincia','municipio','estado','created_at'])
        ->where([
                ['estado', '<>', '5'],
                ['estado', '<>', '6'],
                ['estado', '<>', '7'],
                ['estado', '<>', '8']
            ])
        ->orderBy('id')->get();
        
        // $soli = Solicitud::all();
        //dd($soli);
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
        
    }

    public function uploadFile($file, $fileName)
    {
        if ($file == null)
            return "";
//            if(Storage::disk('certificates')->exists($fileName))
//                die('Ya existe ese archivo');

        // Storage::putFile($fileName . "." . $file->getClientOriginalExtension(), new File('/app/public/certificacion'));
        $path = $file->storeAs('certificacion', $fileName . "." . $file->getClientOriginalExtension());
        $path = storage_path() . $path;

        return $path;
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
            //Llamado al modelo de traductores para poder guardarlo luego n bd
            $solicitud = Solicitud::findOrFail($solicitudes);
            $solicitud->estado = 2;

            //Este numero de referencia lo voy a generar aleatorio hasta q me den el formato del numero de referencia de cada user
            $random = rand(5, 15);
            $dirUrl = "https://www.esti.cu/pagos/certificacion/";
            $getHash = $solicitud->hashSeguridad;
            $mensaje = $dirUrl . $getHash;
            // dd($dirCompleta);
            Mail::to([$solicitud->email,'danilo.arrieta@esti.cu'])->queue(new MensajeRecibido($mensaje,$solicitud));
            // $solicitud->referencia = $random;
            $solicitud->save();
        

        return redirect('/solicitudes')->with('mensaje','Se ha aprobado la solicitud correctamente y se ha enviado un correo al usuario');
    }

    public function denegarInscripcionMensaje(Request $request, $solicitudes)
    {
            //Llamado al modelo de traductores para poder guardarlo luego n bd
            $solicitud = Solicitud::findOrFail($solicitudes);
            $solicitud->estado = 8;
            $solicitud->razones = $request->id_Razones;
            $solicitud->razonesDenegar = $request->razon;
          
            $solicitud->save();
            // dd($solicitud);

            Mail::to($solicitud->email)->bcc('danilo.arrieta@esti.cu')->queue(new MensajeInscripcionCancelacion($solicitud));

        return redirect('/solicitudes')->with('mensaje','Ha denegado una inscipción correctamente y se ha enviado un correo al usuario');
    }

    
    public function enviarCorreo()
    {
        //Llamado al modelo de traductores para poder guardarlo luego n bd
        $solicitud = Solicitud::where('estado',2)->get();
        $cont = 0;
        
        // dd($dirCompleta);
        foreach ($solicitud as $sol) {
            $dirUrl = "https://www.esti.cu/pagos/certificacion/";
            $getHash = $sol->hashSeguridad;
            $mensaje = $dirUrl . $getHash;
            Mail::to($sol->email)->send(new MensajeRecibido($mensaje,$sol));

            // dd($sol->email);
            // if ($cont < 1 ) {
            // Mail::to($sol->email)->send(new MensajeRecibido($mensaje,$sol));
            // }
            $cont++;
        }
        return $cont;
        // $solicitud->referencia = $random;
        // $solicitud->save();
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

    // public function foto($solicitudes)
    // {
    //     $fotoUser = Solicitud::where('id', $solicitudes)->firstOrFail();
    //     $carnetUser = $fotoUser->carnet;
    //     $rutaFotoBD = $fotoUser->file_foto;
    //     $filepath = public_path() . "/certificacion/" .  $rutaFotoBD;
    //     // dd($filepath);
    //     return Response::download($filepath);
    // }
    
    // public function fotos($solicitudes)
    // {
    //     $fotoUser = Solicitud::where('id', $solicitudes)->firstOrFail();
    //     $carnetUser = $fotoUser->carnet;
    //     $rutaFotoBD = $fotoUser->file_foto;
    //     $tipoArchivo = explode(".",$rutaFotoBD);
    //     $tipo = $tipoArchivo[6];

    //     $rutaCambiada = str_replace($rutaFotoBD,$carnetUser. "/foto.".$tipo,$rutaFotoBD);
    //     $filepath = public_path() . "/certificacion/" .  $rutaCambiada;
    //     return Response::download($filepath);
    // }

    // public function carnet1($solicitudes)
    // {
    //     $anversoUser = Solicitud::where('id', $solicitudes)->firstOrFail();
    //     $carnetUser = $anversoUser->carnet;
    //     $rutaFotoBD = $anversoUser->file_carnet1;
    //     $filepath = public_path() . "/certificacion/" .  $rutaFotoBD;
    //     // dd($rutaCambiada);
    //     return Response::download($filepath);
    // }

    // public function carnet2($solicitudes)
    // {
    //     $reversoUser = Solicitud::where('id', $solicitudes)->firstOrFail();
    //     //dd($fotoUser);
    //     $carnetUser = $reversoUser->carnet;
    //     $rutaFotoBD = $reversoUser->file_carnet2;
    //     $filepath = public_path() . "/certificacion/" .  $rutaFotoBD;
    //     return Response::download($filepath);
    // }

    // public function tit($solicitudes)
    // {
    //     $titUser = Solicitud::where('id', $solicitudes)->firstOrFail();
    //     $carnetUser = $titUser->carnet;
    //     $rutaFotoBD = $titUser->file_titulo;
    //     $filepath = public_path() . "/certificacion/" .  $rutaFotoBD;
    //     return Response::download($filepath);
    // }

    // public function ante($solicitudes)
    // {
    //     $anteUser = Solicitud::where('id', $solicitudes)->firstOrFail();
    //     $carnetUser = $anteUser->carnet;
    //     $rutaFotoBD = $anteUser->file_antecedentes;
    //     $filepath = public_path() . "/certificacion/" .  $rutaFotoBD;

    //     if (file_exists($filepath . $carnetUser . "antecedentes")) {
    //         return Response::download($filepath);
    //     } else {
    //         // dd("b");
    //         return view('/solicitudes/solicitudesGeneral')->with('mensaje','La imagen solicitada no existe');

    //     }     
    // }

}
