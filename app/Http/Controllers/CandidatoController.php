<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Candidato;
use App\TipoVotacion;
use App\Votacion;
use App\CandidatoDto;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{

    protected $CUENTA_GANACHE = '0x5f71535c17f31f223D681fF12cDf3250cD84e25b';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;
        session_start();

        if (!empty($keyword)) {
            $candidato = Candidato::where('nombrecandidato', 'LIKE', "%$keyword%")
                ->orWhere('apellidocandidato', 'LIKE', "%$keyword%")
                ->orWhere('foto', 'LIKE', "%$keyword%")
                ->orWhere('idvotacion', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $candidato = Candidato::latest()->paginate($perPage);
        }

        return view('admin.candidato.index', compact('candidato', 'sqln'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        session_start();
        $idv = $_SESSION["idvotacion"];
        return view('admin.candidato.create', compact('idv'));
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
        $requestData = $request->all();
        $json = new CandidatoDto();
        $json->nombre = $request->nombrecandidato . ' ' . $request->apellidocandidato;
        $json->account = $this->CUENTA_GANACHE;
        $campos = [
            'nombrecandidato' => 'required|string|max:100|min:2',
            'apellidocandidato' => 'required|string|max:100|min:2',
            'foto' => 'required|max:10000|mimes:jpeg,jpg,png'
        ];
        $Mensaje = ["required" => 'El campo es requerido.',
                    "min" => 'Dato no válido, mínimo debe tener 3 caracteres',
                    "mimes" => 'El formato de la foto debe ser jpeg, jpg o png'        
    ];

        $this->validate($request, $campos, $Mensaje);
        if ($request->hasFile('foto')) {
            $requestData['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        /*$clientico = new Client([
            'base_uri' => 'http://localhost:3000/',
            'timeout'  => 300.0,
        ]);
        $clientico->request('POST', 'agregarCandidato', ['json' => $json]);*/
        $requestData['idvotacion'] = $_SESSION["idvotacion"];
        Candidato::create($requestData);

        $redireccion = 'votacion/' . $_SESSION["idvotacion"];

        return redirect($redireccion)->with('flash_message', 'Candidato creado.');
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

        $sqln = Votacion::distinct()->select('nombrevotacion')
            ->join('candidatos', 'candidatos.idvotacion', '=', 'votacions.id')
            ->where('votacions.id', '=', $candidato->idvotacion)
            ->get()->first();

        return view('admin.candidato.show', compact('candidato', 'sqln'));
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
        $candidato = Candidato::findOrFail($id);
        return view('admin.candidato.edit', compact('candidato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        session_start();
        $requestData = $request->all();
        $campos = [
            'nombrecandidato' => 'required|string|max:100|min:2',
            'apellidocandidato' => 'required|string|max:100|min:2',
            'foto' => 'required|max:10000|mimes:jpeg,jpg,png'
        ];
        if ($request->hasFile('foto')) {
            $campos += ['foto' => 'max:10000|mimes:jpeg,jpg,png'];
            $candidato = Candidato::findOrFail($id);
            Storage::delete(['public/' . $candidato->foto]);
            $requestData['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        $Mensaje = ["required" => 'El campo es requerido.',
                    "min" => 'Dato no válido, mínimo debe tener 3 caracteres',
                    "mimes" => 'El formato de la foto debe ser jpeg, jpg o png'        
        ]  ;

        $this->validate($request, $campos, $Mensaje);
        $candidato = Candidato::findOrFail($id);
        $candidato->update($requestData);

        $redireccion = 'votacion/' . $_SESSION["idvotacion"];

        return redirect($redireccion)->with('flash_message', 'Candidato updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        session_start();
        $candidato = Candidato::findOrFail($id);
        if ($candidato->foto != null) {

            Storage::delete(['public/' . $candidato->foto]);
        }
        Candidato::destroy($id);
        $redireccion = 'votacion/' . $_SESSION["idvotacion"];

        return redirect($redireccion)->with('flash_message', 'Candidato borrado.');
    }
}
