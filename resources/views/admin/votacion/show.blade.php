@php
    $_SESSION["idvotacion"] = $votacion->id;
@endphp
@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #007b3e" >
                        <a style="color: #ffffff"> 
                            Votacion {{ $votacion->id }}
                        </a>
                    </div>
                    <div class="card-body" id="div1">
                        <a href="{{ url('/votacion') }}" title="Atrás"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <a href="{{ url('/votacion/' . $votacion->id . '/edit') }}" title="Editar Votacion"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                        <form id="form1" method="POST" action="{{ url('votacion' . '/' . $votacion->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Borrar Votacion" onclick="return confirm(&quot;¿Está seguro de eliminar este registro?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</button>
                        </form>
                        
                        <br/>
                        <br/>
                    </div>
                    <div class="card-body" id="div2">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $votacion->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Nombre votación </th>
                                        <td> {{ $votacion->nombrevotacion }} </td>
                                    </tr>
                                    <tr>
                                        <th> Tipo de votación </th>
                                        <td> {{ $sqln->nombretipo }} </td>
                                    </tr>
                                    <tr>
                                        <th> Fecha inicio </th>
                                        <td> {{ $votacion->fechainicio }} </td>
                                    </tr>
                                    <tr>
                                        <th> Hora inicio </th>
                                        <td> {{ $votacion->horainicio }} </td>
                                    </tr>
                                        <th> Duración </th>
                                        <td> {{ $votacion->duracion }} horas</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>            
                        <div class="card">
                            <div class="card-header" style="background-color: #007b3e" >
                                <a style="color: #ffffff"> 
                                   Candidatos de esta votación {{ $votacion->id }}
                                </a>
                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <a href="{{ url('/candidato/create') }}" class="btn btn-success btn-sm" title="Agregar Candidato">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Agregar Candidato
                                </a>
                            </div>         
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

                                            <form id="form2" method="POST" action="{{ url('/candidato' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar Candidato" onclick="return confirm(&quot;¿Está seguro de eliminar este registro?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar </button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">{!! $candidato->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
@endsection
