<?php

namespace App\Http\Controllers\Cabinet\Publications\Scientific\Patents;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\Publications\Patents\StoreRequest;
use App\Services\Publications\Patent\Repository\Contracts\Repository as PatentRepository;
use App\Services\Publications\Patent\StorageService\Contracts\StorageServiceInterface;
use App\Services\Publications\PatentBulletin\Repository\Contracts\Repository as PatentBulletinRepository;
use App\Services\Utilities\PublicationStorage\Contracts\PublicationStorageInterface;
use Illuminate\Contracts\Filesystem\Filesystem as Storage;
use Illuminate\Contracts\Auth\Guard as Auth;
use Illuminate\Http\Request;

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
        return view('cabinet.publications.scientific.patents.create', ['patentBulletins' => $this->patentBulletinRepository->all()]);
    }

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

    public function show(int $patentId)
    {
        $patent = $this->patentRepository->getWithRelationsById($patentId, ['user', 'authors', 'patentBulletin']);

        return view('cabinet.publications.scientific.patents.show', ['patent' => $patent]);
    }

    /**
     * @param int $articleId
     * @param Storage $storage
     */
    public function file(int $articleId, Storage $storage)
    {
//        $file = $this->patentRepository->getFileById($articleId);
//        if ($file && $storage->exists($file->getActualPath())) {
//            return response()->file($file->path);
//        }
//
//        return response()->view('cabinet.errors.file_not_found');

        // TODO Вынести отдельно
    }

    /**
     * @param int $articleId
     * @param Storage $storage
     */
    public function download(int $articleId, Storage $storage)
    {
//        $file = $this->patentRepository->getFileById($articleId);
//        if ($file && $storage->exists($file->getActualPath())) {
//            return response()->download($file->path);
//        }
//
//        return response()->view('cabinet.errors.file_not_found');
        // TODO Вынести отдельно
    }
}