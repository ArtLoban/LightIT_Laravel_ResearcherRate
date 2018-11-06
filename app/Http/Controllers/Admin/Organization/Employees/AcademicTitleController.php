<?php

namespace App\Http\Controllers\Admin\Organization\Employees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Employees\AcademicTitle\Repository\Contracts\Repository as AcademicTitleRepository;

class AcademicTitleController extends Controller
{
    /**
     * @var AcademicTitleRepository
     */
    private $academicTitleRepository;

    /**
     * AcademicTitleController constructor.
     * @param AcademicTitleRepository $academicTitleRepository
     */
    public function __construct(AcademicTitleRepository $academicTitleRepository)
    {
        $this->academicTitleRepository = $academicTitleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.academic_titles.index', ['academicTitles' => $this->academicTitleRepository->all()]);
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
