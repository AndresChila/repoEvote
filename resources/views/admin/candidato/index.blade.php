@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #007B3E" >
                    <a style="color: #ffffff">
                        Candidato
                        </a>

                    </div>
                   
                    
                    <div class="card-body">
                        <a href="{{ url('/candidato/create') }}" class="btn btn-success btn-sm" title="Agregar Candidato">
                            <i class="fa fa-plus" aria-hidden="true"></i> Agregar Candidato
                        </a>

                        <form method="GET" action="{{ url('/candidato') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>Nombre Candidato</th><th>Apellido Candidato</th><th>Foto</th><th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($candidato as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nombrecandidato }}</td>
                                        <td>{{ $item->apellidocandidato }}</td>
                                        
                                        <td> 
                                            @if(isset($item->foto))
                                            <br/>
                                               <img src="{{ asset('storage').'/'. $item->foto }}" alt="" width="150" class="img-thumbnail img-fluid">
                                            <br/>
                                            @endif 
                                        </td>
                                        <td>
                                            <a href="{{ url('/candidato/' . $item->id) }}" title="Ver Candidato"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('/candidato/' . $item->id . '/edit') }}" title="Editar Candidato"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                            <form method="POST" action="{{ url('/candidato' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar Candidato" onclick="return confirm(&quot;¿Está seguro de eliminar este registro?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $candidato->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
                
    