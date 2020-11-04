@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #007b3e" >
                        <a style="color: #ffffff"> 
                            Votaciones próximas
                        </a>
                    </div>                    
                    <div class="card-body">
                        <a href="{{ url('/votacion/create') }}" class="btn btn-success btn-sm" title="Añadir Votacion">
                            <i class="fa fa-plus" aria-hidden="true"></i> Nueva Votación
                        </a>

                        <form method="GET" action="{{ url('/votacion') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                        @if(sizeof($votacion) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre votación</th>
                                        <th>Fecha inicio</th>
                                        <th>Hora inicio</th>
                                        <th>Duración</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($votacion as $item)
                                    <tr>
                                        
                                        <td>{{ $item->nombrevotacion }}</td>
                                        <td>{{ $item->fechainicio }}</td>
                                        <td>{{ $item->horainicio }} </td>
                                        <td>{{ $item->duracion}}</td>
                                        <td>
                                            <a href="{{ url('/votacion/' . $item->id) }}" title="Ver Votacion"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver </button></a>
                                            <a href="{{ url('/votacion/' . $item->id . '/edit') }}" title="Editar Votacion"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar </button></a>

                                            <form method="POST" action="{{ url('/votacion' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar Votacion" onclick="return confirm(&quot;¿Está seguro de eliminar este registro?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $votacion->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                        @else
                            <div class="card">
                                No hay votaciones próximas creadas en el momento.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
