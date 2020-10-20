@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #007b3e" >
                    <a style="color: #ffffff">
                    Candidato {{ $candidato->id }}</div>
                    </a>
                    <div class="card-body">

                        <a href="{{ url('/votacion/'. $candidato->idvotacion) }}" title="Atrás"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás </button></a>
                        <a href="{{ url('/candidato/' . $candidato->id . '/edit') }}" title="Edit Candidato"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar </button></a>

                        <form method="POST" action="{{ url('candidato' . '/' . $candidato->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Candidato" onclick="return confirm(&quot;¿Está seguro de eliminar este registro?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Borrar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $candidato->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Nombre Candidato </th>
                                        <td> {{ $candidato->nombrecandidato }} </td>
                                    </tr>
                                    <tr>
                                        <th> Apellido Candidato </th>
                                        <td> {{ $candidato->apellidocandidato }} </td>
                                    </tr>
                                    <tr>
                                        <th> Nombre votacion </th>
                                        <td> {{$sqln->nombrevotacion}} </td>
                                    </tr>
                                    <tr><th> Foto </th>
                                        <td> 
                                            @if(isset($candidato->foto))
                                            <br/>
                                               <img src="{{ asset('storage').'/'. $candidato->foto }}" alt="" width="150" class="img-thumbnail img-fluid">
                                            <br/>
                                            @endif 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
