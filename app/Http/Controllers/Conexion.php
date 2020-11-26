<?php

namespace App\Http\Controllers;

class Conexion 
{
    //IP servicio de autenticacion
    protected $IP_SERVER = '3.91.59.186';

    public function conectar(){
        return $this->IP_SERVER;
    }
}