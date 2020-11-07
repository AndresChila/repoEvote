@php                            
    $usuario = $_SESSION["usuario"];
    $nombre = $_SESSION["nombre"];
    $apellido = $_SESSION["apellido"];
    
@endphp

@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row">
        @include('paraVotar.sidebardos')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #007b3e">
                    <a style="color: #ffffff"> Bienvenido {{ $nombre }} {{ $apellido }} </a>
                    </div>
                    <div class="card-body">
                        @if(sizeof($votaciones) >= 1)
                        <div class="table-secondary">
                            <table class="table">
                                <thead>
                                    <div class="card-header" style="background-color: #ffd700 ">
                                        Votaciones disponibles para despues de las {{ $actual }}
                                    </div>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <th>Nombre votación</th>
                                        <th>Fecha inicio</th>
                                        <th>Hora inicio</th>
                                        <th>Duración</th>
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
                                        {{$item->hora}}
                                    </td>
                                    <td>
                                        {{$item->duracion}} horas
                                        </td>
                                    </td>
                                       
                                </tr>                        
                                @endforeach
                                </tbody>
                            </table> 
                        </div>
                        @else
                        <div class="card-header" style="background-color: #ffd700">
                            No hay votaciones programadas.
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection