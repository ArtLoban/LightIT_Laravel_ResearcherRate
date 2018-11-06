<?php

namespace App\Http\Controllers\Admin\Organization\Employees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Employees\AcademicDegree\Repository\Contracts\Repository as AcademicDegreeRepository;

class AcademicDegreeController extends Controller
{
    /**
     * @var AcademicDegreeRepository
     */
    private $academicDegreeRepository;

    /**
     * AcademicDegreeController constructor.
     * @param AcademicDegreeRepository $academicDegreeRepository
     */
    public function __construct(AcademicDegreeRepository $academicDegreeRepository)
    {
        $this->academicDegreeRepository = $academicDegreeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.academic_degrees.index', ['academicDegrees' => $this->academicDegreeRepository->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
