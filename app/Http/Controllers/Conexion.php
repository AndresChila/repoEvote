<?php

namespace App\Http\Controllers;

class Conexion 
{
    //IP servicio de autenticacion
    protected $IP_SERVER = '54.160.244.55';

    public function conectar(){
        return $this->IP_SERVER;
    }
}