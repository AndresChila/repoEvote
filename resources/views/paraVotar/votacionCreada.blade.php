@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
        @include('paraVotar.sidebardos')
        <div class="col-md-9">
            <div class="card">
                <div class="card-header" style="background-color: #007b3e" >
                <a style="color: #ffffff">Voto registrado</a>
                </div>
                <div class="card-body">
                    Su voto ha sido creado.
                    </br>
                    Hora:
                    </br>
                     {{ date('h:i:s d-m-Y ')}}
                     </br>
                     Gracias por participar en la votación
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
