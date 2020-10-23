@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @include('paraVotar.sidebardos')

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
                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <script type="text/javascript">
                                google.charts.load('current', {'packages':['corechart']});
                                google.charts.setOnLoadCallback(drawChart);
                                function drawChart(){
                                    var data = google.visualization.arrayToDataTable([
                                        ['votos', 'cantidad'],
                                        @foreach ($candidatos as $item)
                                            ['{{ $item->nombrecandidato }} {{ $item->apellidocandidato }}', {{ $item->numvotos }}],
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
