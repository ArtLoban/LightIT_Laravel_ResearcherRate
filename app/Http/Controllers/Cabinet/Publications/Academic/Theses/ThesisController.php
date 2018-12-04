<?php

namespace App\Http\Controllers\Cabinet\Publications\Academic\Theses;

use App\Http\Controllers\Controller;

class ThesisController extends Controller
{
    public function index()
    {
        return view('cabinet.publications.academic.theses.index');
    }
}