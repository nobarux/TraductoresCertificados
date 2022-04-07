<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarCorreo;

class EnviarMailController extends Controller
{
    function enviarCorreo(Request $request)
    {
        // $this->validate($request, [
        //     'name'     =>  'required',
        //     'email'  =>  'required|email',
        //     'message' =>  'required'
        //    ]);

        $data = array(
            'correo'      =>  $request->correoEmail,
            'mensaje'   =>   $request->mensaje
        );
        // dd($data);
        Mail::to($request->correoEmail)->send(new EnviarCorreo($data));
        return back()->with('mensaje', 'Se ha enviado correctamente el correo!');
     //return 'something';
    }
}
