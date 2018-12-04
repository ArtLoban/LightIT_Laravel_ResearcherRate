<?php

namespace App\Http\Controllers\Admin\Organization\Employees;

use App\Http\Controllers\Controller;
use App\Models\Organization\Employees\AcademicDegree;
use App\Http\Requests\Admin\Organization\Employees\AcademicDegree\StoreRequest;
use App\Http\Requests\Admin\Organization\Employees\AcademicDegree\UpdateRequest;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.academic_degrees.index', ['academicDegrees' => $this->academicDegreeRepository->all()]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.academic_degrees.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->academicDegreeRepository->create($request->all());

        return redirect()->route('academic_degrees.index');
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param AcademicDegree $academicDegree
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(AcademicDegree $academicDegree)
    {
        return view('admin.academic_degrees.edit', ['academicDegree' => $academicDegree]);
    }

    /**
     * @param UpdateRequest $request
     * @param AcademicDegree $academicDegree
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, AcademicDegree $academicDegree)
    {
        $this->academicDegreeRepository->updateById($academicDegree->getKey(), $request->input());

        return redirect()->route('academic_degrees.index');
    }

    /**
     * @param AcademicDegree $academicDegree
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AcademicDegree $academicDegree)
    {
        $this->academicDegreeRepository->delete($academicDegree);

        return back();
    }
}
