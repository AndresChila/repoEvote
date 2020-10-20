@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #007b3e" >
                        <a style="color: #ffffff"> 
                            Votaciones finalizadas
                        </a>
                    </div>               
                    
                    
                    <div class="card-body">
                        

                        <form method="GET" action="{{ url('/graficos') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar" value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                   
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre votacion</th>
                                        
                                        <th>Fecha Realización</th>
                                        <th>Duración</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($votacion as $item)
                                    <tr>
                                        
                                        <td>{{ $item->nombrevotacion }}</td>
                                        
                                        <td>{{ $item->fechainicio }}</td>
                                        <td>{{ $item->duracion}}</td>
                                        <td>
                                            <a href="{{ url('/graficos/index2/' . $item->id) }}" title="Ver Votacion"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver reporte de votación </button></a>                                            
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $votacion->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
