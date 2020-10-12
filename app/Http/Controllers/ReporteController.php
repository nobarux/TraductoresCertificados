<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reporte;
use App\Provincia;
use App\Idiomas;
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

    public function reporteTrad(Request $request)
    {
        $soli= Reporte::all();
        return view('reportes.reporteTraductor', ['reportes' => $soli]);
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
