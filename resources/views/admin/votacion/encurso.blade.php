@extends('layouts.admin')

@section('content')
<div class="container">
        <div class="row">
        @include('admin.sidebar')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #007b3e">
                    <a style="color: #ffffff"> 
                        Votaciones en curso
                    </a>
                    </div>
                    <div class="card-body">
                        <div class="table-secondary">
                            <table class="table">
                                <thead>
                                    
                                        <th>Nombre votación</th>
                                        <th>Fecha inicio</th>
                                        <th>Hora inicio</th>
                                        <th>Duración</th>
                                
                                </thead>
                                
                                <tbody>
                                    
                                    @foreach ($votacion as $item)
                                    <tr>
                                        <td>                                              
                                            {{
                                                $item->nombrevotacion
                                                
                                            }}                                       
                                        </td>
                                        <td>
                                            {{$item->fechainicio}}
                                        </td>
                                        <td>
                                            {{$item->horainicio}}
                                        </td>
                                        <td>
                                            {{$item->duracion}} horas
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