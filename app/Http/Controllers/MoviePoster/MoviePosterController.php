<?php

namespace App\Http\Controllers\MoviePoster;

use App\Http\Controllers\Controller;
use App\Services\MoviePoster\Contracts\MoviePosterService;

class MoviePosterController extends Controller
{
    /**
     * @var MoviePosterService
     */
    private $moviePoster;

    /**
     * MoviePosterController constructor.
     * @param MoviePosterService $moviePoster
     */
    public function __construct(MoviePosterService $moviePoster)
    {
        $this->moviePoster = $moviePoster;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('movie_poster.index', ['movies' => $this->moviePoster->getMovies()]);
    }
}
