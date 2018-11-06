<?php

namespace App\Http\Controllers\Admin\Organization\Facility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Facility\Faculty\Repository\Contracts\Repository as FacultyRepository;

class FacultyController extends Controller
{
    /**
     * @var FacultyRepository
     */
    private $facultyRepository;

    /**
     * FacultyController constructor.
     * @param FacultyRepository $facultyRepository
     */
    public function __construct(FacultyRepository $facultyRepository)
    {
        $this->facultyRepository = $facultyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.faculties.index', ['faculties' => $this->facultyRepository->all()]);
    }
}
