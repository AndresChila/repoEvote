
@extends('layouts.logg')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #007b3e">
                <a style="color: #ffffff"> Código de verificación</a>
                </div>

                <div class="panel-body">
        <div class="flash-message">       
            
            @if($error == 1)
                <p class="alert alert-" style="color: red" >Codigo de verificación no coincide <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif       
        </div> <!-- end .flash-message -->
     <?php
        $variableOTP = $algo;
     ?>
                <form method="POST" action="{{ url('/segundoLogin') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                        Ingrese código de verificación que le fue enviado a la aplicación (ISVote):
                        <br></br>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Código:</label>

                            <div class="col-md-8">
                                
                                <input id="user" type="user" class="form-control" name="user" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('user'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                     
                            </div>
                        </div>
                    
                            
                        <div class="form-group" style=".flex-center" >
                            <div class="col-md-8 col-md-offset-4" >                               
                                
                                    <button class="form-control" style="background-color: #fec006" ><i class="fa fa-arrow-left" aria-hidden="true" ></i> Ingresar </button>
        
                               
                                
                            </div>
                        </div>
                        
                    
                     </form>                                  
                </div>
                
            </div>
            
        </div>
        
    </div>
    
</div>

@endsection

