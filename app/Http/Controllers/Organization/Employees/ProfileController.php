<?php

namespace App\Http\Controllers\Organization\Employees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Employees\Profile\Repository\Contracts\Repository as ProfileRepository;
use App\Services\Organization\Employees\Position\Repository\Contracts\Repository as PositionRepository;
use App\Services\Organization\Employees\AcademicDegree\Repository\Contracts\Repository as AcademicDegreeRepository;
use App\Services\Organization\Employees\AcademicTitle\Repository\Contracts\Repository as AcademicTitleRepository;
use App\Services\Organization\Facility\Department\Repository\Contracts\Repository as DepartmentRepository;

class ProfileController extends Controller
{
    /**
     * @var ProfileRepository
     */
    private $profileRepository;

    /**
     * ProfileController constructor.
     * @param ProfileRepository $profileRepository
     */
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allprofilesWithRelations = $this->profileRepository->allWithRelations([
            'academicDegree',
            'academicTitle',
            'position',
            'department',
            'user'
        ]);


//        dd($allprofilesWithRelations);

        return view('admin.profiles.index', ['profiles' => $allprofilesWithRelations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(
        PositionRepository $positionRepository,
        AcademicDegreeRepository $academicDegreeRepository,
        AcademicTitleRepository $academicTitleRepository,
        DepartmentRepository $departmentRepository
    ) {
        return view('admin.profiles.create', [
            'positions' => $positionRepository->all(),
            'academicDegrees' => $academicDegreeRepository->all(),
            'academicTitles' => $academicTitleRepository->all(),
            'departments' => $departmentRepository->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
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
