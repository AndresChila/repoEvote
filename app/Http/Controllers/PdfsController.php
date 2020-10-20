<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade;

class PdfsController extends Controller
{
    public function index(Request $request){
        session_start();
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        $products = $_SESSION["reportes"];

        $pdf = Facade::loadView('pdfs.index', compact('products'));

        return $pdf->download('listado.pdf');
    }
}
