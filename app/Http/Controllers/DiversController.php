<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiversController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showSelectDemande()
    {
        return view('Divers.selectDemande');
    }
}
