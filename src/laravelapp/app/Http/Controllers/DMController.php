<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DMController extends Controller
{
    public function index()
    {
        return view('dm.index');
    }
}
