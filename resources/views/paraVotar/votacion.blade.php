@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row">
        @include('paraVotar.sidebardos')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #007b3e">
                    <a style="color: #ffffff">Registre su voto. </a>
                    </div>
                    <div id="countdown" class="form-control" style="background-color: #ffd700">
                        Cargando...
                        <script>         
                            var end = new Date ('<?=$nuevahora?>');//mes-dia-anio
                                var _second = 1000;
                                var _minute = _second * 60;
                                var _hour = _minute * 60;
                                var _day = _hour * 24;
                                var _label = "Tiempo restante: ";
                                var timer;
                                function showRemaining() {
                                    var now = new Date();
                                    var distance = end - now;
                                    if (distance < 0) {                            
                                        clearInterval(timer);
                                        document.getElementById('countdown').innerHTML = 'SE ACABO EL TIEMPO!';                                        
                                        divd.style = "display:none";
                                        return;
                                    }         
                                    
                                    var days = Math.floor(distance / _day);
                                    var hours = Math.floor((distance % _day) / _hour);
                                    var minutes = Math.floor((distance % _hour) / _minute);
                                    var seconds = Math.floor((distance % _minute) / _second);
                                    document.getElementById('countdown').innerHTML = _label;
                                    document.getElementById('countdown').innerHTML += days + ' dias, ';
                                    document.getElementById('countdown').innerHTML += hours + ' horas, ';
                                    document.getElementById('countdown').innerHTML += minutes + ' minutos y ';
                                    document.getElementById('countdown').innerHTML += seconds + ' segundos';
                                    
                                }
                                
                                timer = setInterval(showRemaining, 1000);
                            </script>                
                        </div>
                        
                        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                        <!-- Include all compiled plugins (below), or include individual files as needed -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>                                               

                        
                    @if($sql != null )
                        <div id="divd"  name="divd" class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                    @foreach($sql as $candidato)
                                        <th>
                                            <label value="{{ $candidato->id }}"> {{$candidato->nombrecandidato}} {{$candidato->apellidocandidato}} </label> 
                                        </th>
                                    @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    @foreach($sql as $candidato)    
                                        <td>
                                        <img src="{{ asset('storage').'/'. $candidato->foto }}" alt="" width="150" class="img-thumbnail img-fluid">
                                        </td>
                                        <br/>
                                        <br/>
                                        
                                    @endforeach 
                                    </tr>
                                    <tr>
                                        @foreach($sql as $candidato)    
                                            <td>
                                                <a href="{{ url('/paraVotar/show/' . $candidato->id) }}" title="Votar"><button id="buttoncito" class="btn btn-warning btn-sm"><i class="fa fa-arrow-up" aria-hidden="true"></i> Votar</button></a>                                           
                                            </td>                                        
                                        @endforeach    
                                    </tr>                                    
                                </tbody>
                            </table>                            
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    
@endsection