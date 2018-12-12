<?php

namespace App\Http\Controllers\Admin\Publications;

use App\Http\Controllers\Controller;
use App\Models\Publications\Patents\Patent;
use App\Http\Requests\Cabinet\Publications\Patents\StoreRequest;
use App\Http\Requests\Cabinet\Publications\Patents\UpdateRequest;
use App\Services\Publications\Patents\Patent\StorageService\Contracts\StorageServiceInterface;
use App\Services\Publications\Patents\Patent\Repository\Contracts\Repository as PatentRepository;
use App\Services\Publications\Patents\PatentBulletin\Repository\Contracts\Repository as PatentBulletinRepository;

class PatentController extends Controller
{
    /**
     * @var PatentRepository
     */
    private $patentRepository;

    /**
     * @var PatentBulletinRepository
     */
    private $patentBulletinRepository;

    /**
     * PatentController constructor.
     * @param PatentRepository $patentRepository
     */
    public function __construct(PatentRepository $patentRepository, PatentBulletinRepository $patentBulletinRepository)
    {
        $this->patentRepository = $patentRepository;
        $this->patentBulletinRepository = $patentBulletinRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.publications.patents.index')
            ->with(['patents' => $this->patentRepository->allWithRelations(['user', 'authors', 'patentBulletin'])]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.publications.patents.create')
            ->with([
                'patentBulletins' => $this->patentBulletinRepository->allSortedByDateField()
            ]);
    }

    /**
     * @param StoreRequest $request
     * @param StorageServiceInterface $storageService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, StorageServiceInterface $storageService)
    {
        $storageService->create(
            $request->all(),
            $request->user()->getKey(),
            $this->patentRepository,
            $this->patentBulletinRepository
        );

        return redirect()->route('patents.index');
    }

    /**
     * @param int $patentId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $patentId)
    {
        $patent = $this->patentRepository->getWithRelationsById($patentId, ['user', 'authors', 'patentBulletin']);

        return view('admin.publications.patents.show', ['patent' => $patent]);
    }

    /**
     * @param Patent $patent
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Patent $patent)
    {
        return view('admin.publications.patents.edit')
            ->with([
                'patent' => $patent,
                'patentBulletins' => $this->patentBulletinRepository->allSortedByDateField()
            ]);
    }

    /**
     * @param UpdateRequest $request
     * @param int $patentId
     * @param StorageServiceInterface $storageService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $patentId, StorageServiceInterface $storageService)
    {
        $storageService->update(
            $request->all(),
            $patentId,
            $this->patentRepository,
            $this->patentBulletinRepository
        );

        return redirect()->route('patents.index');
    }

    /**
     * @param Patent $patent
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Patent $patent)
    {
        $this->patentRepository->delete($patent);

        return redirect()->route('patents.index');
    }
}
