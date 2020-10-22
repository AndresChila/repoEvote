<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $IP_SERVER = '52.23.235.46';
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(Request $request)
    {
        
        return view('auth.login');//, compact('tipovotacion'));
    }
    
    public function redireccionar(Request $request){
        $us = new User();
        $us->user = $request->user;
        $us->contrasena = $request->contrasena;

        $campos=[
            'user'=>'required|numeric|max:9999999999'
        ];
        $Mensaje = ["required" => 'El campo es requerido',
                "numeric" => 'El usuario solo puede contener números',
                "max" => 'Ingrese una cédula válida'
        ];

        $this->validate($request, $campos, $Mensaje);

        if($us->user == '1070248506' and $us->contrasena == 'Ud3c2020'){
            session_start();
            $_SESSION["usuario"] = 'admin';
            
            return redirect('votacion');
        }
        else{        
            $clientico = new Client([
                // Base URI is used with relative requests
                'base_uri' => 'http://'. $this->IP_SERVER .':8080/autenticacion-app/rest/personas/',
                // You can set any number of default request options.
                'timeout'  => 2.0,      
            ]);
            $response = $clientico->request('POST', 'autenticar', ['json' =>$us]);
            $cual = $response->getBody()->getContents();
            
            if($cual == !null ){                
                session_start();   
                $_SESSION["sede"] = json_decode($cual)->idSede->nombre;
                $_SESSION["carrera"] = json_decode($cual)->idPrograma->nombre;           
                $_SESSION["otp"] = json_decode($cual)->OTP;
                $_SESSION["usuario"] = json_decode($cual)->idTipoPer->descripcion;
                $_SESSION["nombre"] = json_decode($cual)->nombre;
                $_SESSION["codigo"] = json_decode($cual)->codigo;
                $_SESSION["apellido"] = json_decode($cual)->apellido;
                $aaa['error'] = -2;
                $aaa['algo'] =json_decode($cual)->OTP;
                return view('auth.segundoLogin', $aaa);
            }else{
                return redirect('auth')->with('flash_message', '.');
            }
        }
    }
    

    public function segundoLogin(Request $request)
    {
        session_start();     

        $aaa['algo']= $_SESSION["otp"] ." " . $request->user;
        $aaa['rol']= $_SESSION["usuario"];
        $aaa['nombre'] = $_SESSION["nombre"];
        $aaa['apellido'] = $_SESSION["apellido"];        
        $aaa['codigo'] = $_SESSION["codigo"];

        if( $_SESSION["otp"] == $request->user){
            return redirect('paraVotar');
        }

        $aaa['error'] = 1;

        return view('auth.segundoLogin',$aaa, compact('flash_message', '.'));
       
    }

    public function cerrarsesion(){
        session_start();

        $_SESSION["otp"] = null;
        $_SESSION["codigo"] = null;
        $_SESSION["nombre"] = null;
        $_SESSION["usuario"] = null;
        $_SESSION["apellido"] = null;
        $_SESSION["idvotacion"] = null;
        $_SESSION["ganador"] = null;
        $_SESSION["reportes"] = null;
        $_SESSION["sede"] = null;
        $_SESSION["carrera"] = null;

        return view('auth.login');
    }
        
}