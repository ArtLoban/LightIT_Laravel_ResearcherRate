<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Show the application main page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cabinet.profiles');
    }
}
