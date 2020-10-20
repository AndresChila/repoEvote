@extends('layouts.admin')

@section('content')
    <div class="container">  

        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9" > 
                <div class="card" >
                    <div class="card-header" style="background-color: #007B3E" >
                    <a style="color: #ffffff"> 
                    Crear nuevo tipo de Votación
            </a></div>
                    <div class="card-body">
                        <a href="{{ url('/tipo-votacion') }}" title="Atrás"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <br />
                        <br />

                        

                        <form method="POST" action="{{ url('/tipo-votacion') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.tipo-votacion.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
