@extends('layouts.admin')

@section('content')



    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #007B3E" >
        <a style="color: #ffffff"> 
            Tipo Votacion
            </a>
        </div>
                    <div class="card-body">
                        <a href="{{ url('/tipo-votacion/create') }}" class="btn btn-success btn-sm" title="Añadir nuevo">
                            <i class="fa fa-plus" aria-hidden="true"></i> Añadir
                        </a>

                        <form method="GET" action="{{ url('/tipo-votacion') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
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
                                        <th>#</th><th>Nombre tipo</th><th>Ocupación permitida</th><th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($tipovotacion as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nombretipo }}</td><td>{{ $item->ocupacionpermitida }}</td>
                                        <td>
                                            
                                            <a href="{{ url('/tipo-votacion/' . $item->id . '/edit') }}" title="Editar"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar </button></a>

                                            <form method="POST" action="{{ url('/tipo-votacion' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm(&quot;¿Está seguro que desea eliminar este registro?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $tipovotacion->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
