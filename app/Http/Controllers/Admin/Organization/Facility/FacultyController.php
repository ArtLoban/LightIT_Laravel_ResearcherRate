<?php

namespace App\Http\Controllers\Admin\Organization\Facility;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Organization\Facility\Faculty\UpdateRequest;
use App\Http\Requests\Admin\Organization\Facility\Faculty\StoreRequest;
use App\Models\Organization\Facility\Faculty;
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.faculties.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->facultyRepository->create($request->all());

        return redirect()->route('faculties.index');
    }

    /**
     * @param Faculty $faculty
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Faculty $faculty)
    {
        return view('admin.faculties.edit', ['faculty' => $faculty]);
    }

    /**
     * @param UpdateRequest $request
     * @param Faculty $faculty
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Faculty $faculty)
    {
        $this->facultyRepository->updateById($faculty->getKey(), $request->input());

        return redirect()->route('faculties.index');
    }

    /**
     * @param Faculty $faculty
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Faculty $faculty)
    {
        $this->facultyRepository->delete($faculty);

        return back();
    }
}
