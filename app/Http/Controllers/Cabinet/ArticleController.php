<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Show the application main page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cabinet.articles');
    }
}
