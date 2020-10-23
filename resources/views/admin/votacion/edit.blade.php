@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #007b3e" >
                    <a style="color: #ffffff"> 
                            Editar Votacion #{{ $votacion->id }}
                    </a>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/votacion') }}" title="Atrás"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <br />
                        <br />

                        <form method="POST" action="{{ url('/votacion/' . $votacion->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.votacion.form', ['formMode' => 'edit'])

                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
