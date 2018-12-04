<?php

namespace App\Http\Controllers\Cabinet\Publications\Scientific\Theses;

use App\Http\Controllers\Controller;

class ThesisController extends Controller
{
    public function index()
    {
        return view('cabinet.publications.scientific.theses.index');
    }
}