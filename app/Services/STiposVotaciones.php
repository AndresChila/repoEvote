<?php

namespace App\Service;

use\App\TipoVotacion;

class STipoVotaciones
{

    public function get(){
        $tiposv = TipoVotacion::get();
        $tiposv[''] = '-- Seleccione un tipo de votación --';
        foreach($tiposv as $tipo){
            $tiposv[$tipo->id] = $tiposv->nombretipo;
        }

    }

}