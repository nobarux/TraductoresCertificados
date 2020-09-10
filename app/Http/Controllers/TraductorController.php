<?php

namespace App\Http\Controllers;

use App\Traductores;
use App\Idiomas;
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
      //dd($request); //Esto creo q es un var dump
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
        
        

        if($request->hasFile('image_url'))
        {
            // Obtener los archivos del formulario
            $fileNameWithTheExtension = request('image_url')->getClientOriginalName();

            //Obtener el nombre del archivo
            $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
            
            //Obtener la extenion del archivo a guardar
            $extension = request('image_url')->getClientOriginalExtension();
            
            //Creacion de un nombre nuevo para guaradarlo en bd
            $newFileName = $fileName . '_' . time() . '.' . $extension;
            
            
            //Redirigir los archivos para una carpeta publica
            $path = request('image_url')->storeAs('public/imagenesTraductores',$newFileName);
            //dd($path);
        }
        else {
            $newFileName = "";
            // dd($newFileName);
        }
        
        
        if($request->hasFile('ant_penales'))
        {
            $fileNameAnt= request('ant_penales')->getClientOriginalName();
            //Obtener el nombre del archivo
            $fileNameAntecedentes = pathinfo($fileNameAnt, PATHINFO_FILENAME);

            $extensionAntecedentes = request('ant_penales')->getClientOriginalExtension();

            $newFileNameAntecedentes = $fileNameAntecedentes . '_' . time() . '.' . $extensionAntecedentes;
            // dd($newFileNameAntecedentes);

            $pathAntecedente = request('ant_penales')->storeAs('public/documentosTraductores',$newFileNameAntecedentes);
            //dd($pathAntecedente);
        }
        else {
            $newFileNameAntecedentes = "";
        }

        if($request->hasFile('curriculum'))
        {
            $fileNameCurric= request('curriculum')->getClientOriginalName();
            $fileNameCurriculum = pathinfo($fileNameCurric, PATHINFO_FILENAME);
            $extensionCurriculum = request('curriculum')->getClientOriginalExtension();
            $newFileNameCurriculum = $fileNameCurriculum . '_' . time() . '.' . $extensionCurriculum;
            $pathCurriculum = request('curriculum')->storeAs('public/documentosTraductores',$newFileNameCurriculum);
            // dd($fileNameCurriculum);

        }
        else {
            $newFileNameCurriculum = "";
            //dd($newFileNameCurriculum);
        }

        //Saber el ultimo numero de solicitud
        $last_solicitud = Traductores::select('num_Solicitud')
        ->orderBy('id','desc')
        ->first();
        // dd($last_solicitud);

        if ($last_solicitud->num_Solicitud != null) {
            //Si el año no es el actual empieza el numero de solicitud en uno
            $last_anno = Traductores::select('anno')
            ->orderBy('id','desc')
            ->first();
            if ($last_anno->anno < $Year) {
                $nextSolicitud = 1;
            }
            else {
                //Sumarle uno al numero de solicitud para hacerle el continuo
                $nextSolicitud = $last_solicitud->num_Solicitud + 1;
            }
            
        }
        else {
            $nextSolicitud = 1;
        }
       
       

        
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
        return redirect('/traductores')->with('mensaje','Ha creado un registro correctamente');
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

        $idiomas = Idiomas::all();
        //Retornar a la vista
        return view('/traductores/edit',['trad'=>$trad_id],['idioma'=>$idiomas]);
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
       //dd($request); //Esto creo q es un var dump
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
        'image_url'=> 'image',
        // 'image_url'=> 'file|size:512|image',
        'id_Idioma'=> 'required|not_in:0'
        
      ]);
        
        $estadoSolicitud = Traductores::select('id_Estado')->where('id',$traductores)
        ->first();
        
        $numSolicitud = Traductores::select('num_Solicitud')->where('id',$traductores)
        ->first();
        

        if($request->hasFile('image_url'))
        {
            // Obtener los archivos del formulario
            $fileNameWithTheExtension = request('image_url')->getClientOriginalName();

            //Obtener el nombre del archivo
            $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
            
            //Obtener la extenion del archivo a guardar
            $extension = request('image_url')->getClientOriginalExtension();
            
            //Creacion de un nombre nuevo para guaradarlo en bd
            $newFileName = $fileName . '_' . time() . '.' . $extension;
            
            
            //Redirigir los archivos para una carpeta publica
            $path = request('image_url')->storeAs('public/imagenesTraductores',$newFileName);
            //dd($path);
        }
        else {
            $newFileName = "";
            // dd($newFileName);
        }
        
        
        if($request->hasFile('ant_penales'))
        {
            $fileNameAnt= request('ant_penales')->getClientOriginalName();
            //Obtener el nombre del archivo
            $fileNameAntecedentes = pathinfo($fileNameAnt, PATHINFO_FILENAME);

            $extensionAntecedentes = request('ant_penales')->getClientOriginalExtension();

            $newFileNameAntecedentes = $fileNameAntecedentes . '_' . time() . '.' . $extensionAntecedentes;
            // dd($newFileNameAntecedentes);

            $pathAntecedente = request('ant_penales')->storeAs('public/documentosTraductores',$newFileNameAntecedentes);
            //dd($pathAntecedente);
        }
        else {
            $newFileNameAntecedentes = "";
        }

        if($request->hasFile('curriculum'))
        {
            $fileNameCurric= request('curriculum')->getClientOriginalName();
            $fileNameCurriculum = pathinfo($fileNameCurric, PATHINFO_FILENAME);
            $extensionCurriculum = request('curriculum')->getClientOriginalExtension();
            $newFileNameCurriculum = $fileNameCurriculum . '_' . time() . '.' . $extensionCurriculum;
            $pathCurriculum = request('curriculum')->storeAs('public/documentosTraductores',$newFileNameCurriculum);
            // dd($fileNameCurriculum);

        }
        else {
            $newFileNameCurriculum = "";
            //dd($newFileNameCurriculum);
        }

        
        //Llamado al modelo de traductores para poder guardarlo luego en bd
        $traductor = Traductores::find($traductores);
        // $traductor = new Traductores();
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
        $traductor->id_Estado = $estadoSolicitud->id_Estado;
        $traductor->num_Solicitud =$numSolicitud->num_Solicitud;
        $traductor->anno = $Year;
        // $traductor->num_Solicitud = $nextSolicitud;
        $traductor->save();
        return redirect('/traductores')->with('mensaje','Ha actualizado un registro correctamente');
        //   dd($id_Idioma);
      
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
        /* se convierte esta variable a int para q luego pueda buscar cualquier 
        cosa de la bd por el id q me esta enviando desde la vista*/
        // $intid = intval($traductores);
        // $image = Traductores::select('image_url')->where('id',$intid)
        // ->get();
        // dd($image);

        $nombreImagen = $trad_id->getOriginal('image_url');
       
        //Borrar imagen del traductor cuando este  se elimine de la bd
        $oldImage = public_path() . '/storage/imagenesTraductores/' . $nombreImagen;

        if (file_exists($oldImage)) {
            //Borrar la imagen
            unlink($oldImage);
        }

        //Borrar el traductor
        $trad_id->delete();
        return redirect('/traductores');
    }
}
