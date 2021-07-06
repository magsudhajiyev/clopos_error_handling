<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function index()
    {
        //Intentional call to undefined model

        return Users::all();
    }
}
