<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class ParametrageController extends Controller
{
    public function index()
    {
        return view('parametrage.index');
    }
}