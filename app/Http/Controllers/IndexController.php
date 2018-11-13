<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    /**
     * Show the application main page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }
}
