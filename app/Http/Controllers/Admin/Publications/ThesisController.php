<?php

namespace App\Http\Controllers\Admin\Publications;

use App\Http\Controllers\Controller;
use App\Models\Publications\Theses\Thesis;
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
     * @param ThesisRepository $thesisRepository
     * @param ThesisDigestRepository $thesisDigestRepository
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.publications.theses.index')
            ->with(['theses' => $this->thesisRepository->allWithRelations(['thesisDigest', 'authors', 'publicationType'])]);
    }

    /**
     * @param LanguageRepository $languageRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(LanguageRepository $languageRepository)
    {
        return view('admin.publications.theses.create')
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

        return redirect()->route('theses.index');
    }

    /**
     * @param Thesis $thesis
     * @param LanguageRepository $languageRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Thesis $thesis, LanguageRepository $languageRepository)
    {
        return view('admin.publications.theses.edit')
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

        return redirect()->route('theses.index');
    }

    /**
     * @param Thesis $thesis
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Thesis $thesis)
    {
        $this->thesisRepository->delete($thesis);

        return redirect()->route('theses.index');
    }
}
