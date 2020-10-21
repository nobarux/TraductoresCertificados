<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reporte;
use App\Provincia;
use App\Idioma;
use App\Estado;
use App\Profesion;
use PDF;

class ReporteController extends Controller
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

    public function reporteTrad()
    {
        $reportes= Reporte::where([
            ['estado', '<>', '5'],
            ['estado', '<>', '6'],
        ])->get();
        $idIdio = $reportes[0]->idioma;
        $idProv = $reportes[0]->provincia;
        $idEstado = $reportes[0]->estado;
        $idProf = $reportes[0]->profesion;
        $listaidioma = Idioma::where('id_Idioma', $idIdio)->get();
        $listaprov = Provincia::where('id_Prov', $idProv)->get();
        $listaestado = Estado::where('id_Estados', $idEstado)->get();
        $listaprof = Profesion::where('id_Prof', $idProf)->get();

        return view('reportes.reporteTraductor', ['reportes' => $reportes, 'listaidioma' => $listaidioma, 'listaprov' => $listaprov, 'listaestado' => $listaestado, 'listaprof' => $listaprof]);
    }

    // Generate PDF
    public function downloadPDF() {
        // retreive all records from db
        $data = Reporte::all();
        // share data to view
        view()->share('reportes',$data);
        $pdf = PDF::loadView('reportes.reporteTraductor', $data);
        // download PDF file with download method
        return $pdf->setPaper('a4', 'landscape')
        ->stream('reporte.pdf');
      }


}
