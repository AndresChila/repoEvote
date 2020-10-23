<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TipoVotacion;
use App\Votacion;
use App\Candidato;
use Illuminate\Http\Request;
use DateTime;

class VotacionController extends Controller
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
        $perPage = 25;
        if (!empty($keyword)) {
            $votacion = Votacion::where('realizada', '=', 0)  
                ->where('nombrevotacion', 'LIKE', "%$keyword%")
                ->orWhere('tipovotacion', 'LIKE', "%$keyword%")
                ->orWhere('fechainicio', 'LIKE', "%$keyword%")             
                ->latest()->paginate($perPage);
        } else {
            $votacion = Votacion::latest()->where('realizada', '=', 0)->paginate($perPage);
        }
        

        return view('admin.votacion.index', compact('votacion'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        session_start();
        $roles=TipoVotacion::pluck('nombretipo','id');
        return view('admin.votacion.create', compact('roles'));
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
        $campos=[
            'nombrevotacion' => 'required|string|max:100',
            'tipovotacion' => 'required',
            'fechainicio' => 'required',
            'duracion' => 'required'
        ];
        $fecha= new DateTime($request->fechainicio);
        $str = $fecha->format("y-m-d");
        $request->fechainicio = $str;
        
        $Mensaje=["required"=>'el :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);


        $requestData = $request->all();
        Votacion::create($requestData);
        return redirect('votacion')->with('flash_message', 'Votacion creada');
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
        $perPage = 3;
        $votacion = Votacion::findOrFail($id);
        $candidato = Candidato::distinct()->select('candidatos.id','nombrecandidato','apellidocandidato', 'foto')
        ->join('votacions', 'votacions.id','=','candidatos.idvotacion')
        ->where('candidatos.idvotacion','=',$id)
        ->paginate($perPage);
        $sqln=TipoVotacion::distinct()->select('nombretipo')
        ->join('votacions', 'votacions.tipovotacion','=', 'tipo_votacions.id')
        ->where('votacions.id','=', $votacion->id)
        ->get()->first();        

        return view('admin.votacion.show', compact('votacion','sqln', 'candidato'));
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
        $roles = TipoVotacion::pluck('nombretipo','id');
        $votacion = Votacion::findOrFail($id);
        return view('admin.votacion.edit', compact('votacion', 'roles'));
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
        $campos=[
            'nombrevotacion' => 'required|string|max:100',
            'tipovotacion' => 'required'
        ];
        $Mensaje=["required"=>'el :attribute es requerido'];

        $this->validate($request, $campos, $Mensaje);
        $votacion = Votacion::findOrFail($id);
        $votacion->update($requestData);

        return redirect('votacion')->with('flash_message', 'Votacion updated!');
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
        Votacion::destroy($id);
        return redirect('votacion')->with('flash_message', 'Votacion deleted!');
    }
    public function encurso(){
        session_start();
        $perPage = 25;
        $votacion = Votacion::latest()->where('realizada', '=', 2)->paginate($perPage);    
        return view('admin.votacion.encurso', compact('votacion'));
    }
}
