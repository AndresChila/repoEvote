<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/*
    Clase para llamar al complemento del calendario
*/

class DateController extends Controller
{
    function showDate(Request $request)
    {
        dd($request->date);
    }
}
