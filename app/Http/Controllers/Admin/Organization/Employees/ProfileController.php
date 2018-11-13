<?php

namespace App\Http\Controllers\Admin\Organization\Employees;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Organization\Employees\Profile;
use App\Services\Users\BlankUser\KeyGenerator\Contracts\KeyGenerator;
use App\Http\Requests\Admin\Organization\Employees\Profile\StoreRequest;
use App\Http\Requests\Admin\Organization\Employees\Profile\UpdateRequest;
use App\Services\Users\BlankUser\Repository\Contracts\Repository as BlankUserRepository;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $profiles = $this->profileRepository->getProfilesBySameDepartment(Auth::getUser()->profile);

        return view('admin.profiles.index', ['profiles' => $profiles]);
    }

    /**
     * @param PositionRepository $positionRepository
     * @param AcademicDegreeRepository $academicDegreeRepository
     * @param AcademicTitleRepository $academicTitleRepository
     * @param DepartmentRepository $departmentRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(
        PositionRepository $positionRepository,
        AcademicDegreeRepository $academicDegreeRepository,
        AcademicTitleRepository $academicTitleRepository,
        DepartmentRepository $departmentRepository
    ) {
        return view('admin.profiles.create')
            ->with([
                'positions' => $positionRepository->all(),
                'academicDegrees' => $academicDegreeRepository->all(),
                'academicTitles' => $academicTitleRepository->all(),
                'departments' => $departmentRepository->all(),
            ]);
    }

    /**
     * @param StoreRequest $request
     * @param KeyGenerator $keyGenerator
     * @param BlankUserRepository $blankUserRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, KeyGenerator $keyGenerator, BlankUserRepository $blankUserRepository)
    {
        $newProfile = $this->profileRepository->create($request->all());
        $blankUserRepository->create([
            'personal_key' => $keyGenerator->generate(),
            'profile_id' => $newProfile->getKey()
        ]);

        return redirect()->route('profiles.index');
    }

    /**
     * @param Profile $profile
     * @param PositionRepository $positionRepository
     * @param AcademicDegreeRepository $academicDegreeRepository
     * @param AcademicTitleRepository $academicTitleRepository
     * @param DepartmentRepository $departmentRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(
        Profile $profile,
        PositionRepository $positionRepository,
        AcademicDegreeRepository $academicDegreeRepository,
        AcademicTitleRepository $academicTitleRepository,
        DepartmentRepository $departmentRepository
    ) {
        return view('admin.profiles.edit')
            ->with([
                'profile' => $profile,
                'positions' => $positionRepository->all(),
                'academicDegrees' => $academicDegreeRepository->all(),
                'academicTitles' => $academicTitleRepository->all(),
                'departments' => $departmentRepository->all()
            ]);
    }

    /**
     * @param UpdateRequest $request
     * @param Profile $profile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Profile $profile)
    {
        $this->profileRepository->updateById($profile->getKey(), $request->input());

        return redirect()->route('profiles.index');
    }

    /**
     * @param Profile $profile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Profile $profile)
    {
        $this->profileRepository->delete($profile);

        return back();
    }
}
