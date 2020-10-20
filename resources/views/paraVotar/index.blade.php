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
                    <a style="color: #ffffff">Bienvenido {{ $nombre }} {{ $apellido }}</a>
                    </div>
                    @if(sizeof($votaciones) >= 1)
                        <div class="card-body">
                            <div class="table-secondary">
                                <table class="table">
                                    <thead>
                                        <div class="card-header" style="background-color: #ffd700 ">
                                            Votaciones disponibles en curso 
                                        </div>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Nombre votación</th>
                                            <th>Hora inicio</th>
                                            <th>Duración</th>
                                            <th>Votar</th>
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
                                            {{$item->hora}}
                                        </td>
                                        <td>
                                            {{$item->duracion}} horas
                                        </td>
                                        <td>  
                                                                                     
                                                <a href="{{ url('/paraVotar/' . $item->id . '/edit') }}" >     
                                                
                                                    <button type="submit" class="btn btn-info btn-sm" title=" Votar" >
                                                        Votar
                                                        <i class="fa fa-arrow-circle-right" aria-hidden="true"> </i>         
                                                    </button> 
                                                </a>             
                                        </td>
                                    </tr>                        
                                    @endforeach
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    @else
                        <div class="card-header" style="background-color: #ffd700">
                            A la hora {{$actual}} no hay votaciones disponibles
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection