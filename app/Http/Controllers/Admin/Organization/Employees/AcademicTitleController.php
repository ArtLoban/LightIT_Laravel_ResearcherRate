<?php

namespace App\Http\Controllers\Admin\Organization\Employees;

use App\Http\Controllers\Controller;
use App\Models\Organization\Employees\AcademicTitle;
use App\Http\Requests\Admin\Organization\Employees\AcademicTitle\StoreRequest;
use App\Http\Requests\Admin\Organization\Employees\AcademicTitle\UpdateRequest;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.academic_titles.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->academicTitleRepository->create($request->all());

        return redirect()->route('academic_titles.index');
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param AcademicTitle $academicTitle
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(AcademicTitle $academicTitle)
    {
        return view('admin.academic_titles.edit', ['academicTitle' => $academicTitle]);
    }

    /**
     * @param UpdateRequest $request
     * @param AcademicTitle $academicTitle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, academicTitle $academicTitle)
    {
        $this->academicTitleRepository->updateById($academicTitle->getKey(), $request->input());

        return redirect()->route('academic_titles.index');
    }

    /**
     * @param AcademicTitle $academicTitle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AcademicTitle $academicTitle)
    {
        $this->academicTitleRepository->delete($academicTitle);

        return back();
    }
}
