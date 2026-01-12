<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceholderController extends Controller
{
    public function comingSoon()
    {
        return view('coming-soon');
    }
}
