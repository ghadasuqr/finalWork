<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashctr extends Controller
{
    public function index() 
    {
         return view('backend.layouts.index');
    }
}
