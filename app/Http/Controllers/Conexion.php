<?php

namespace App\Http\Controllers;

class Conexion 
{
    //IP servicio de autenticacion
    protected $IP_SERVER = '35.168.1.29';

    public function conectar(){
        return $this->IP_SERVER;
    }
}