<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votacion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'votacions';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombrevotacion', 'tipovotacion', 'fechainicio', 'duracion', 'realiza', 'horainicio'];

    
}
