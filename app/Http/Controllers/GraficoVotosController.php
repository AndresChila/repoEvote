<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Candidato;
use Illuminate\Http\Request;
use App\Votacion;
use App\Votoxlugar;
use App\Votoxcarrera;
use Barryvdh\DomPDF\Facade;

class GraficoVotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        session_start();
        $keyword = $request->get('search');
        $perPage = 5;
        if (!empty($keyword)) {
            $votacion = Votacion::where('realizada', '=', 1)
                ->where('nombrevotacion', 'LIKE', "%$keyword%")
                ->orWhere('tipovotacion', 'LIKE', "%$keyword%")
                ->orWhere('fechainicio', 'LIKE', "%$keyword%")
                
                ->latest()->paginate($perPage);
        } else {
            $votacion = Votacion::latest()->where('realizada', '=', 1)->paginate($perPage);
        }

        return view('admin.graficos.reportes', compact('votacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        session_start();
        $idv = $request->select;
        if ($idv == 1) {
            $candidatos = Candidato::distinct()->select('nombrecandidato', 'apellidocandidato', 'numvotos')
                ->where('idvotacion', '=', $_SESSION["idvotacion"])
                ->get()->all();
        }
        if ($idv == 3) {
            $candidatos = Votoxcarrera::distinct()->select('numvotos', 'nombre as nombrecandidato')
                ->where('idcandidato', '=', $request->cand)
                ->get()->all();
        }

        if ($idv == 2) {
            $candidatos = Votoxlugar::distinct()->select('numvotos', 'nombre as nombrecandidato')
                ->where('idcandidato', '=', $request->cand)
                ->get()->all();
        }
        

        $candidatos1 = Candidato::where('idvotacion', '=', $_SESSION["idvotacion"])
            ->get()->all();
        
        $candmayor = $_SESSION["ganador"];
        return view('admin.graficos.index', compact('candidatos', 'candidatos1', 'candmayor'));
    }


    /**
     * Esta funcion sirve para cargar el grafico de los resultados 
     */

    public function index2($id)
    {

        session_start();
        $_SESSION["idvotacion"] = $id;
        $candidatos = Candidato::distinct()->select('nombrecandidato', 'apellidocandidato', 'numvotos', 'id')
            ->where('idvotacion', '=', $id)
            ->get()->all();

        $candidatos1 = Candidato::where('idvotacion', '=', $id)
            ->get()->all();

        $nummayor = 0;
        $candmayor = '';
        foreach ($candidatos as $cand) {
            if ($cand->numvotos > $nummayor) {
                $candmayor = $cand->nombrecandidato . ' ' .$cand->apellidocandidato;
                $nummayor = $cand->numvotos;
            }
        }
        $_SESSION["ganador"] = $candmayor;
        return view('admin.graficos.index', compact('candidatos', 'candidatos1', 'candmayor'));
    }

    public function pdf()
    {
        session_start();
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
         **/
        $candidatos = $_SESSION["reportes"];
        $ganador = $_SESSION["ganador"];
        $id = $_SESSION["idvotacion"];
        $candidatos1 = Candidato::join('votacions', 'votacions.id', '=', 'candidatos.idvotacion')
            ->select(
                'candidatos.nombrecandidato',
                'candidatos.apellidocandidato',
                'candidatos.numvotos AS votocand',
                'votacions.fechainicio',
                'votacions.horainicio',
                'votacions.nombrevotacion',
                'candidatos.foto'
            )
            ->where('votacions.id', '=', $id)
            ->get()
            ->all();
        $carreras= Candidato::join('votoxcarrera', 'votoxcarrera.idcandidato','=', 'candidatos.id')
        ->join('votacions', 'votacions.id', '=', 'candidatos.idvotacion')
        ->select('candidatos.nombrecandidato',
                'candidatos.apellidocandidato',
                'votoxcarrera.nombre AS nomcarrera',
                'votoxcarrera.numvotos AS votcarrera')
        ->where('votacions.id', '=', $id)
        ->get()->all();
        $sedes =Candidato::join('votoxlugar', 'votoxlugar.idcandidato','=', 'candidatos.id')
        ->join('votacions', 'votacions.id', '=', 'candidatos.idvotacion')
        ->select('candidatos.nombrecandidato',
                'candidatos.apellidocandidato',
                'votoxlugar.nombre AS nomlugar',
                'votoxlugar.numvotos AS votlugar')
        ->where('votacions.id', '=', $id)
        ->get()->all();

        $pdf = Facade::loadView('admin.pdfs.index', compact('candidatos1', 'ganador','carreras','sedes'));
        $pdf->setOptions(['enable-javascript', true]);
        $pdf->setOptions(['javascript-delay <msec>', 1000]);
        $pdf->setOptions(['no-stop-slow-scripts', true]);
        $pdf->setOptions(['enable-smart-shrinking', true]);
        return $pdf->stream('');
    }
}
