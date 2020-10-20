@php                            
    $usuario = $_SESSION["usuario"]
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@if($usuario == null || $usuario != 'admin')
    {{
        $usuario
    }}
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 36px;
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    Parece que no ha iniciado sesión. 
                    

                </div>
                <a href="{{ url('/auth')}}" title="Iniciar Sesión">
                    <button> 
                        Ir al inicio de sesión.                            
                    </button> 
                </a>
            </div>
        </div>
    </body>

@else

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=2">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html, body {
            align-items: none;
        }
        .flex-center {
            align-items: center;
            display: center;
            justify-content: none;
        }
    </style>

    <!--Ajax--> 
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container" style="background-color:#004828">
                <div class="navbar-header" >

                    <!-- Collapsed Hamburger -->
                    
                     <!-- Branding Image -->
                    <a class="navbar-brand" style="color: #79C000" >
                        AB-Vote
                    </a>
                </div>
                    <a href="{{ url('/cerrarsesion')}}" title="Cerrar Sesión">
                        <button class="btn btn-danger" aria-hidden="true"> 
                            <i class="fa fa-power-off">  </i>                            
                        </button> 
                    </a>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;  
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                    Usuario
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="auth">
                                    algo
                                    </a>
                                    <a class="dropdown-item" href="auth">
                                    algo
                                    </a>
                                    <a class="dropdown-item" href="auth">
                                    algo
                                    </a>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4" style=".flex-center">
            @yield('content')
        </main>
    </div>
@endif
    <!-- Scripts -->
    <script type="text/javascript">
        $('.date').datepicker({  
           format: 'yyyy/mm/dd',
           language: "es",
           startDate: "today",
            daysOfWeekDisabled: "0,6",
            todayBtn: true,
            orientation: "bottom left"
         });  
    </script>  
</body>
</html>
