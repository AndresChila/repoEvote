@php
    $_SESSION["reportes"] = $candidatos;
@endphp

@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #007B3E" >
                    <a style="color: #ffffff">
                        Resultados
                        </a>
                    </div>
                    <div class="card-header" style="background-color: #ffd700" >
                            <a style="color: #000000">
                                El candidato ganador fue: {{$candmayor}}
                            </a>
                        </div>
                        

                        

                        <form method="POST" action="{{ url('/graficos') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <label  class="control-label">{{ 'Filtrar por:' }}</label>
                            </br>
                            <label for="cand" class="control-label">{{ 'Candidato: ' }}</label>
                            </br>
                            <select class="form-control" id ="cand" name="cand" >
                                @foreach($candidatos1 as $item)
                                    <option value="{{$item->id}}" >{{$item->nombrecandidato}}</option> 
                                @endforeach
                            </select>
                            </br>
                            <label for="select" class="control-label">{{ 'Tipo de filtro por: ' }}</label>
                            <select class="form-control" id ="select" name="select" >
                                <option value="1" >Totales</option> 
                                <option value="2" >Por sede</option>
                                <option value="3" >Por carrera</option>
                            </select>
                            </br>
                            <div class="form-group">
                                <input class="form-control" type="submit" value="Buscar">
                            </div>
                        </form>
                        @if(sizeof($candidatos)>=1)
                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <script type="text/javascript">
                                google.charts.load('current', {'packages':['corechart']});
                                google.charts.setOnLoadCallback(drawChart);
                                function drawChart(){
                                    var data = google.visualization.arrayToDataTable([
                                        ['votos', 'cantidad'],
                                        @foreach ($candidatos as $item)
                                            ['{{ $item->nombrecandidato }}', {{ $item->numvotos }}],
                                        @endforeach                                    
                                    ]);
                                    var options = {
                                        title:'Grafico de resultados'
                                    };
                                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                                    chart.draw(data,options);
                                }
                            </script>                   
                            
                            <div id="piechart" style="width: 900px; height: 500px;"></div>
                        
                            <div>
                                <a href="{{ route('pdf.vista') }}" class="btn btn-sm btn-primary">
                                    Descargar reporte en PDF
                                </a>
                            </div>
                        @else
                            <div>
                               No hay datos para mostrar con este filtro
                            </div>  
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
