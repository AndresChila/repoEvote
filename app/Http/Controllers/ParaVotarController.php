<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Candidato;
use App\Voto;
use App\Votoxlugar;
use App\Votoxcarrera;
use App\Votacion;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;

class ParaVotarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        session_start();

        $fecha = new DateTime(Carbon::now());
        $str = $fecha->format("y-m-d");
        $actual = $fecha->format("h:i A");

        $votaciones = Votacion::distinct()
            ->join('tipo_votacions', 'tipo_votacions.id', '=', 'votacions.tipovotacion')
            ->select('votacions.id', 'votacions.nombrevotacion', 'tipo_votacions.nombretipo AS tipo', 'votacions.horainicio AS hora', 'votacions.duracion AS duracion')
            ->where('tipo_votacions.ocupacionpermitida', 'like', '%' . $_SESSION["usuario"] . '%')
            ->where('votacions.fechainicio', '=', $str)
            ->whereRaw("CURTIME() BETWEEN  votacions.horainicio AND ADDTIME(votacions.horainicio, CONCAT(votacions.duracion, ':00:00'))")
            ->where('votacions.realizada', '=', 2)
            ->whereRaw("votacions.id NOT IN (select voto.votacion FROM voto WHERE cedulavotante =" . $_SESSION["codigo"] . ")")
            ->get()->all();


        $hoy = $fecha->format("d-m-Y");
        $_SESSION["votaciones"] = $votaciones;
        return view('paraVotar.index', compact('votaciones', 'hoy', 'actual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        session_start();
        return view('paraVotar.create');
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

        $candidato = Candidato::findOrFail($request->id);
        $nuevo = $candidato->numvotos + 1;
        Candidato::where('id', $request->id)->update(['numvotos' => $nuevo]);

        return view('paraVotar.votacionCreada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        session_start();

        $candidato = Candidato::findOrFail($id);
        $nuevo = $candidato->numvotos + 1;
        Candidato::where('id', $id)->update(['numvotos' => $nuevo]);
        return view('paraVotar.votacionCreada', compact('nuevo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        session_start();
        $sql = Candidato::distinct()->select('candidatos.id', 'candidatos.nombrecandidato', 'candidatos.apellidocandidato', 'candidatos.foto', 'candidatos.idvotacion')
            ->where('candidatos.idvotacion', '=', $id)
            ->get()->all();

        $sql1 = Votacion::where('id', '=', $id)
        ->get()->all();

        $validar = Votacion::join('voto','voto.votacion','=', 'votacions.id')
        ->where('votacions.id', '=', $id)
        ->where('voto.cedulavotante','=', $_SESSION["codigo"])
        ->where('realizada','=', 2)
        ->get()->all();


        $_SESSION["idvotacion"] = $id;
        $horas = new DateTime($sql1[0]->fechainicio . $sql1[0]->horainicio);
        $hr = $horas->format('m/d/y g:i A');
        $nuevahora = strtotime('+' . $sql1[0]->duracion . ' hour', strtotime($hr));
        $nuevahora = date('m/d/y g:i A', $nuevahora);


        return view('paraVotar.votacion', compact('sql', 'validar', 'nuevahora'));
    }

    /**
     * Metodo que almacena el vot en bd
     */

    public function votar($id)
    {
        session_start();
        $varuno = Votoxlugar::where('nombre', 'LIKE', '%' . $_SESSION["sede"] . '%');
        $vardos = Votoxcarrera::where('nombre', 'LIKE', '%' . $_SESSION["carrera"] . '%');
        if ($varuno == null) {
            $cantidad = $varuno->numvotos + 1;
            Votoxlugar::where('nombre', $_SESSION["sede"])->update(['numvotos' => $cantidad]);
        } else {
            $votoxlugar["nombre"] = $_SESSION["sede"];
            $votoxlugar["idcandidato"] = $id;

            Votoxlugar::create($votoxlugar);
        }
        if ($vardos == null) {
            $cantidad = $vardos->numvotos + 1;
            Votoxcarrera::where('nombre', $_SESSION["carrera"])->update(['numvotos' => $cantidad]);
        } else {
            $votoxcarrera["nombre"] = $_SESSION["carrera"];
            $votoxcarrera["idcandidato"] = $id;

            Votoxcarrera::create($votoxcarrera);
        }


        $voto["cedulavotante"] = $_SESSION["codigo"];
        $voto["votacion"] = $_SESSION["idvotacion"];

        Voto::create($voto);

        $candidato = Candidato::findOrFail($id);
        $nuevo = $candidato->numvotos + 1;
        Candidato::where('id', $id)->update(['numvotos' => $nuevo]);
        return view('paraVotar.votacionCreada', compact('nuevo'));
    }

    public function buscar_proximas()
    {
        session_start();
        $fecha = new DateTime(Carbon::now());
        $str = $fecha->format("y-m-d");
        $actual = $fecha->format("h:i A");
        $hoy = $fecha->format("d-m-Y");
        $votaciones = Votacion::distinct()
            ->join('tipo_votacions', 'tipo_votacions.id', '=', 'votacions.tipovotacion')
            ->select('votacions.id', 'votacions.nombrevotacion', 'tipo_votacions.nombretipo AS tipo', 'votacions.horainicio AS hora', 'votacions.duracion AS duracion', 'votacions.fechainicio AS fecha')
            ->where('tipo_votacions.ocupacionpermitida', 'like', '%' . $_SESSION["usuario"] . '%')
            ->where('votacions.fechainicio', '>=', $str)
            ->where('votacions.realizada', '=', 0)
            ->whereRaw("CURTIME() NOT BETWEEN  votacions.horainicio AND ADDTIME(votacions.horainicio, CONCAT(votacions.duracion, ':00:00'))")
            ->whereRaw("votacions.id NOT IN (select voto.votacion FROM voto WHERE cedulavotante =" . $_SESSION["codigo"] . ")")
            ->get()->all();

        $_SESSION["votaciones"] = $votaciones;



        return view('paraVotar.proximas', compact('votaciones', 'hoy', 'actual'));
    }

    public function buscar_participadas()
    {
        session_start();
        $fecha = new DateTime(Carbon::now());
        $str = $fecha->format("y-m-d");
        $actual = $fecha->format("H:i");
        $hoy = $fecha->format("d-m-Y");
        $votaciones = Votacion::distinct()
            ->join('tipo_votacions', 'tipo_votacions.id', '=', 'votacions.tipovotacion')
            ->select('votacions.id', 'votacions.nombrevotacion', 'tipo_votacions.nombretipo AS tipo', 'votacions.horainicio AS hora', 'votacions.duracion AS duracion', 'votacions.fechainicio AS fecha')
            ->where('tipo_votacions.ocupacionpermitida', 'like', '%' . $_SESSION["usuario"] . '%')
            ->where('votacions.fechainicio', '<=', $str)
            ->where('votacions.realizada', '=', 1)
            ->whereRaw("votacions.id IN (select voto.votacion FROM voto WHERE cedulavotante =" . $_SESSION["codigo"] . ")")
            ->get()->all();
        $_SESSION["votaciones"] = $votaciones;

        return view('paraVotar.realizadas', compact('votaciones', 'hoy'));
    }

    public function grafico($id)
    {
        session_start();
        $_SESSION["idvotacion"] = $id;

        $candidatos = Candidato::distinct()->select('nombrecandidato','apellidocandidato', 'numvotos', 'id')
            ->where('idvotacion', '=', $id)
            ->get()->all();

        $nummayor = 0;
        $candmayor = '';
        foreach ($candidatos as $cand) {
            if ($cand->numvotos > $nummayor) {
                $candmayor = $cand->nombrecandidato . ' ' . $cand->apellidocandidato;
            }
        }

        $candidatos = Candidato::distinct()->select('nombrecandidato','apellidocandidato', 'numvotos', 'id')
            ->where('idvotacion', '=', $id)
            ->get()->all();

        return view('paraVotar.graficovotante', compact('candidatos', 'candmayor'));
    }
}
