<?php

namespace App\Http\Controllers\Admin\Organization\Facility;

use App\Http\Controllers\Controller;
use App\Models\Organization\Facility\Department;
use App\Http\Requests\Admin\Organization\Facility\Department\StoreRequest;
use App\Http\Requests\Admin\Organization\Facility\Department\UpdateRequest;
use App\Services\Organization\Facility\Faculty\Repository\Contracts\Repository as FacultyRepository;
use App\Services\Organization\Facility\Department\Repository\Contracts\Repository as DepartmentRepository;

class DepartmentController extends Controller
{
    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * DepartmentController constructor.
     * @param DepartmentRepository $departmentRepository
     */
    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.departments.index', ['departments' => $this->departmentRepository->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FacultyRepository $facultyRepository)
    {
        return view('admin.departments.create', ['faculties' => $facultyRepository->all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->departmentRepository->create($request->all());

        return redirect()->route('departments.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department, FacultyRepository $facultyRepository)
    {
        return view('admin.departments.edit', ['department' => $department, 'faculties' => $facultyRepository->all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Department $department)
    {
        dd($request->cookie('name'));
        $this->departmentRepository->updateById($department->getKey(), $request->input());

        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $this->departmentRepository->delete($department);

        return back();
    }
}
