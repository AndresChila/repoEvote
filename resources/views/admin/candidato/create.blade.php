@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #007b3e">
                    <a style="color: #ffffff">
                        Agregar Nuevo Candidato a la votación {{ $idv }}
                        
                    </a>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/votacion' . '/' . $idv) }}" title="Atrás"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás </button></a>
                        <br />
                        <br />           
                        

                        <form method="POST" action="{{ url('/candidato') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.candidato.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
