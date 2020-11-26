<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\TipoVotacion;
use App\Http\Controllers\Conexion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TipoVotacionController extends Controller
{
    //IP servicio de autenticacion
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        session_start();
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $tipovotacion = TipoVotacion::where('nombretipo', 'LIKE', "%$keyword%")
                ->orWhere('ocupacionpermitida', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $tipovotacion = TipoVotacion::latest()->paginate($perPage);
        }

        return view('admin.tipo-votacion.index', compact('tipovotacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        session_start();
        $IP_SERVER = (new Conexion)->conectar();
        $cliente = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://'. $IP_SERVER .':8080/autenticacion-app/rest/utils/',
            // You can set any number of default request options.
            'timeout'  => 30.0,      
        ]);
        $response = $cliente->request('GET', 'tiposPersona');
        $consult = json_decode($response->getBody()->getContents());
        $collection = collect($consult);
        $collection1 = $collection->pluck('descripcion','id');
        
        return view('admin.tipo-votacion.create', compact('collection1'));
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
        $IP_SERVER = (new Conexion)->conectar();
        $cliente = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://'. $IP_SERVER .':8080/autenticacion-app/rest/utils/',
            // You can set any number of default request options.
            'timeout'  => 30.0,      
        ]);
        $response = $cliente->request('GET', 'tiposPersona');
        $consult = json_decode($response->getBody()->getContents());
        $collection = collect($consult);
        $collection1 = $collection->pluck('descripcion','id');
        $band = '';
        $pointer = 1;
        $fill = false;
        foreach( $collection1 as $key => $value ){
            if($request->$pointer == 'on'){
                    $band = $band.$value.', ';
                    $fill = true;
            }            
            $pointer++;
        }
        
        $campos = $request->all();
        $campos=[
            'nombretipo' => 'required|string|max:100'             
        ];
        if($fill == false){
            $campos+=['ocupacionpermitida' => 'required'];
        }
        $Mensaje=["required"=>'el :attribute es requerido'];

        $this->validate($request, $campos, $Mensaje);
        
        
        $requestData['nombretipo'] = $request->nombretipo;
        $requestData['ocupacionpermitida'] = $band;

        TipoVotacion::create($requestData);
        return redirect('tipo-votacion')->with('flash_message', 'TipoVotacion added!');
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
        return view('admin.tipo-votacion.show');
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
        $IP_SERVER = (new Conexion)->conectar();
        $tipovotacion = TipoVotacion::findOrFail($id);
        $cliente = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://'. $IP_SERVER .':8080/autenticacion-app/rest/utils/',
            // You can set any number of default request options.
            'timeout'  => 30.0,      
        ]);
        $response = $cliente->request('GET', 'tiposPersona');
        $consult = json_decode($response->getBody()->getContents());
        $collection = collect($consult);
        $collection1 = $collection->pluck('descripcion','id');
        return view('admin.tipo-votacion.edit', compact('tipovotacion'), compact('collection1'));
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
        $IP_SERVER = (new Conexion)->conectar();
        $cliente = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://'. $IP_SERVER .':8080/autenticacion-app/rest/utils/',
            // You can set any number of default request options.
            'timeout'  => 30.0,      
        ]);
        $response = $cliente->request('GET', 'tiposPersona');
        $consult = json_decode($response->getBody()->getContents());
        $collection = collect($consult);
        $collection1 = $collection->pluck('descripcion','id');
        $band = '';
        $pointer = 1;
        $fill = false;
        foreach( $collection1 as $key => $value ){
            if($request->$pointer == 'on'){
                    $band = $band.$value.', ';
                    $fill = true;
            }            
            $pointer++;
        }
        
        $campos = $request->all();
        $campos=[
            'nombretipo' => 'required|string|max:100'             
        ];
        if($fill == false){
            $campos+=['ocupacionpermitida' => 'required'];
        }
        $Mensaje=["required"=>'el :attribute es requerido'];

        $this->validate($request, $campos, $Mensaje);
        
        
        $requestData['nombretipo'] = $request->nombretipo;
        $requestData['ocupacionpermitida'] = $band;
        
        $tipovotacion = TipoVotacion::findOrFail($id);

        $tipovotacion->update($requestData);

        return redirect('tipo-votacion')->with('flash_message', 'TipoVotacion updated!');
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
        TipoVotacion::destroy($id);
        return redirect('tipo-votacion')->with('flash_message', 'TipoVotacion deleted!');
    }
}
