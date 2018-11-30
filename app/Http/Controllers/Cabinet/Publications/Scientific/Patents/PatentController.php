<?php

namespace App\Http\Controllers\Cabinet\Publications\Scientific\Patents;

use App\Http\Controllers\Controller;
use App\Models\Publications\Patents\Patent;
use Illuminate\Contracts\Auth\Guard as Auth;
use App\Http\Requests\Cabinet\Publications\Patents\StoreRequest;
use App\Http\Requests\Cabinet\Publications\Patents\UpdateRequest;
use App\Services\Utilities\Files\FileDownloader\Contracts\FileDownloaderInterface as FileDownloader;
use App\Services\Publications\Patent\StorageService\Contracts\StorageServiceInterface;
use App\Services\Publications\Patent\Repository\Contracts\Repository as PatentRepository;
use App\Services\Publications\PatentBulletin\Repository\Contracts\Repository as PatentBulletinRepository;

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


    public function __construct(PatentRepository $patentRepository, PatentBulletinRepository $patentBulletinRepository)
    {
        $this->patentRepository = $patentRepository;
        $this->patentBulletinRepository = $patentBulletinRepository;
    }

    /**
     * @param Auth $auth
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Auth $auth)
    {
        $patents = $this->patentRepository->getAllWithRelationsBy('user_id', $auth->id(), ['user', 'authors', 'patentBulletin']);

        return view('cabinet.publications.scientific.patents.index', ['patents' => $patents]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('cabinet.publications.scientific.patents.create')
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

        return redirect()->route('scientific.patents.index')->with('status', 'The new patent is added!');
    }

    /**
     * @param int $patentId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $patentId)
    {
        $patent = $this->patentRepository->getWithRelationsById($patentId, ['user', 'authors', 'patentBulletin']);

        return view('cabinet.publications.scientific.patents.show', ['patent' => $patent]);
    }

    /**
     * @param Patent $patent
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Patent $patent)
    {
        return view('cabinet.publications.scientific.patents.edit')
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

        return redirect()->route('scientific.patents.show', $patentId)->with('status', 'The patent is updated!');
    }

    /**
     * @param Patent $patent
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Patent $patent)
    {
        $this->patentRepository->delete($patent);

        return redirect()->route('scientific.patents.index')->with('status', 'The patent has been deleted!');
    }

    /**
     * @param int $patentId
     * @param FileDownloader $fileDownloader
     * @return mixed
     */
    public function file(int $patentId, FileDownloader $fileDownloader)
    {
        return $fileDownloader->fetchFile($this->patentRepository->whereId($patentId), FileDownloader::FILE);
    }

    /**
     * @param int $patentId
     * @param FileDownloader $fileDownloader
     * @return mixed
     */
    public function download(int $patentId, FileDownloader $fileDownloader)
    {
        return $fileDownloader->fetchFile($this->patentRepository->whereId($patentId), FileDownloader::DOWNLOAD);
    }
}