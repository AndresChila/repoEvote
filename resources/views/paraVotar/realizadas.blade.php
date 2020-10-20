@php                            
    $usuario = $_SESSION["usuario"];
    $nombre = $_SESSION["nombre"];
    $apellido = $_SESSION["apellido"];
    
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
        @include('paravotar.sidebardos')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #007b3e">
                    <a style="color: #ffffff"> Bienvenido {{ $nombre }} {{ $apellido }} </a>
                    </div>
                    <div class="card-body">
                        <div class="table-secondary">
                            <table class="table">
                                <thead>
                                    <div class="card-header" style="background-color: #ffd700 ">
                                        Votaciones realizadas anteriores a {{ $hoy }}
                                    </div>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <th>Nombre votación</th>
                                        <th>Fecha </th>                                                                                
                                        <th>Ver</th>
                                    </tr>
                                    @foreach ($votaciones as $item)
                                    <tr>
                                        <td>                                              
                                            {{
                                                $item->nombrevotacion
                                                
                                            }}
                                            -
                                            {{
                                                $item->tipo
                                            }}                                       
                                    </td>
                                    <td>
                                        {{$item->fecha}}
                                    </td>                                    
                                    <td>                                           
                                        <a href="{{ url('paraVotar/grafico/' . $item->id) }}" title="Ver Votacion">
                                            <button class="btn btn-info btn-sm">
                                                <i class="fa fa-eye" aria-hidden="true">
                                                </i> 
                                                Ver resultados.
                                            </button>                                               
                                        </a>             
                                    </td>
                                </tr>                        
                                @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection