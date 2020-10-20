@php                           
    $usuario = $_SESSION["usuario"];     
@endphp


<div id="menu" class="col-md-3">
    <div class="card">
        <div class="card-header" style="background-color: #007B3E" >
        <a style="color: #ffffff"> 
            Votaciones disponibles ({{$usuario}})
            </a>
        </div>

        <div class="card-body">
            <ul class="nav" role="tablist">
                <li role="presentation">                   
                    <a href="{{ url('paraVotar') }}" style="color: #007B3E">
                        Inicio
                    </a>       
                </br>
                </br> 
                    <a href="{{ route('paraVotar.proximas') }}" style="color: #007B3E">
                        Votaciones próximas 
                    </a>        
                </br>
                </br> 
                    <a href="{{ route('paraVotar.realizadas') }}" style="color: #007B3E">
                        Votaciones participadas
                    </a>         
                </li>
            </ul>
        </div>
    </div>
</div>
