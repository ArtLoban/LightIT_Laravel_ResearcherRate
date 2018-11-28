<?php

namespace App\Http\Controllers\Cabinet\Publications\Scientific\Patents;

use App\Http\Controllers\Controller;
use App\Services\Publications\Patent\Repository\Contracts\Repository as PatentRepository;
use Illuminate\Contracts\Auth\Guard as Auth;

class PatentController extends Controller
{
    private $patentRepository;

    public function __construct(PatentRepository $patentRepository)
    {
        $this->patentRepository = $patentRepository;
    }

    public function index(Auth $auth)
    {
        $patents = $this->patentRepository->all();

        return view('cabinet.publications.scientific.patents.index', ['patents' => $patents]);
    }
}