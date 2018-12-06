<?php

namespace App\Http\Controllers\Cabinet\Publications\Academic\Theses;

use App\Models\App\File;
use App\Http\Controllers\Controller;
use App\Models\Publications\Theses\Thesis;
use Illuminate\Contracts\Auth\Guard as Auth;
use Illuminate\Contracts\Filesystem\Filesystem as Storage;
use App\Http\Requests\Cabinet\Publications\Thesis\StoreRequest;
use App\Http\Requests\Cabinet\Publications\Thesis\UpdateRequest;
use App\Utilities\LanguageRepository\Contracts\Repository as LanguageRepository;
use App\Services\Publications\Theses\Thesis\Repository\Contracts\Repository as ThesisRepository;
use App\Services\Publications\Services\PublicationStorage\Contracts\PublicationStorageInterface;
use App\Services\Publications\PublicationType\Repository\Contracts\Repository as PublicationTypeRepository;
use App\Services\Publications\Theses\ThesisDigest\Repository\Contracts\Repository as ThesisDigestRepository;

class ThesisController extends Controller
{
    /**
     * @var PublicationTypeRepository
     */
    private $publicationTypeRepository;

    /**
     * @var ThesisRepository
     */
    private $thesisRepository;

    /**
     * @var ThesisDigestRepository
     */
    private $thesisDigestRepository;

    /**
     * ThesisController constructor.
     * @param PublicationTypeRepository $publicationTypeRepository
     * @param $thesisRepository
     */
    public function __construct(
        PublicationTypeRepository $publicationTypeRepository,
        ThesisRepository $thesisRepository,
        ThesisDigestRepository $thesisDigestRepository
    ) {
        $this->publicationTypeRepository = $publicationTypeRepository;
        $this->thesisRepository = $thesisRepository;
        $this->thesisDigestRepository = $thesisDigestRepository;
    }

    /**
     * @param Auth $auth
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Auth $auth)
    {
        $publicationTypeId = $this->publicationTypeRepository->getAcademicId();
        $theses = $this->thesisRepository->getAllWithRelationsByUserIdAndType($auth->id(), $publicationTypeId);

        return view('cabinet.publications.academic.theses.index', ['theses' => $theses]);
    }

    /**
     * @param LanguageRepository $languageRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(LanguageRepository $languageRepository)
    {
        return view('cabinet.publications.academic.theses.create')
            ->with([
                'publicationTypes' => $this->publicationTypeRepository->all(),
                'languages' => $languageRepository->all(),
            ]);
    }

    /**
     * @param StoreRequest $request
     * @param PublicationStorageInterface $publicationStorage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, PublicationStorageInterface $publicationStorage)
    {
        $publicationStorage->create(
            $request->all(),
            $request->user()->getKey(),
            'thesis_digest_name',
            'thesis_digest_id',
            $this->thesisRepository,
            $this->thesisDigestRepository
        );

        return redirect()->route('academic.theses.index')->with('status', 'The new thesis is added!');
    }

    /**
     * @param int $thesisId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $thesisId)
    {
        $thesis = $this->thesisRepository->getWithRelationsById($thesisId, ['thesisDigest', 'authors', 'publicationType']);

        return view('cabinet.publications.academic.theses.show', ['thesis' => $thesis]);
    }

    /**
     * @param Thesis $thesis
     * @param LanguageRepository $languageRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Thesis $thesis, LanguageRepository $languageRepository)
    {
        return view('cabinet.publications.academic.theses.edit')
            ->with([
                'thesis' => $thesis,
                'languages' => $languageRepository->all(),
                'publicationTypes' => $this->publicationTypeRepository->all()
            ]);
    }

    /**
     * @param UpdateRequest $request
     * @param int $thesisId
     * @param PublicationStorageInterface $publicationStorage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $thesisId, PublicationStorageInterface $publicationStorage)
    {
        $publicationStorage->update(
            $request->all(),
            $thesisId,
            'thesis_digest_name',
            'thesis_digest_id',
            $this->thesisRepository,
            $this->thesisDigestRepository
        );

        return redirect()->route('academic.theses.show', $thesisId)->with('status', 'The thesis is updated!');
    }

    /**
     * @param Thesis $thesis
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Thesis $thesis)
    {
        $this->thesisRepository->delete($thesis);

        return redirect()->route('academic.theses.index')->with('status', 'The thesis has been deleted!');
    }

    /**
     * @param int $thesisId
     * @param Storage $storage
     * @return \Illuminate\Http\Response
     */
    public function displayFile(int $thesisId, Storage $storage)
    {
        $thesis = $this->thesisRepository->whereId($thesisId);
        /**
         * @var File
         */
        $file = $thesis->getFile();

        if ($file && $storage->exists($file->getActualPath())) {
            return response()->file($file->path);
        }

        return response()->view('cabinet.errors.file_not_found');
    }

    /**
     * @param int $thesisId
     * @param Storage $storage
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile(int $thesisId, Storage $storage)
    {
        $thesis = $this->thesisRepository->whereId($thesisId);
        $file = $thesis->getFile();

        if ($file && $storage->exists($file->getActualPath())) {
            return response()->download($file->path);
        }

        return response()->view('cabinet.errors.file_not_found');
    }
}
