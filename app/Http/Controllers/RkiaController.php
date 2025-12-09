<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RkiaController extends Controller
{
    public function timeline()
    {
        return view('rkia.timeline');
    }

    public function program()
    {
        return view('rkia.program');
    }
}
