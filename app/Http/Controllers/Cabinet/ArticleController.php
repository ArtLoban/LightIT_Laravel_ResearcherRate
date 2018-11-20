<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\Article\StoreRequest;
use App\Services\Publications\JournalType\Repository\Contracts\Repository as JournalTypeRepository;
use App\Services\Utilities\LanguageRepository\Contracts\Repository as LanguageRepository;
use App\Services\Publications\Article\Repository\Contracts\Repository as ArticleRepository;
use App\Services\Publications\Article\ArticleStorageService\Contracts\ArticleStorageService;
use App\Services\Publications\PublicationType\Repository\Contracts\Repository as PublicationTypeRepository;

class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Show the application main page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cabinet.publications.scientific.articles.index')
            ->with([
                'articles' => $this->articleRepository->allWithRelations(['journal', 'authors', 'publicationType'])
            ]);
    }

    /**
     * @param PublicationTypeRepository $publicationTypeRepository
     * @param LanguageRepository $languageRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(
        PublicationTypeRepository $publicationTypeRepository,
        LanguageRepository $languageRepository,
        JournalTypeRepository $journalTypeRepository
    ) {
        return view('cabinet.publications.scientific.articles.create')
            ->with([
                'publicationTypes' => $publicationTypeRepository->all(),
                'languages' => $languageRepository->all(),
                'journalTypes' => $journalTypeRepository->all(),
            ]);
    }

    /**
     * @param StoreRequest $request
     * @param ArticleStorageService $articleStorageService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, ArticleStorageService $articleStorageService)
    {
        $articleStorageService->store($request->all());

        return redirect()->route('articles.index')->with('status', 'The new article is added!');
    }

    /**
     * @param $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($article)
    {
        $articleEntity = $this->articleRepository->getWithRelationsById($article, ['journal', 'authors', 'publicationType']);

        return view('cabinet.publications.scientific.articles.show', ['article' => $articleEntity]);
    }

    /**
     * @param $articleId
     * @return mixed
     */
    public function file(int $articleId)
    {
        return response()->file($this->articleRepository->getFilePathById($articleId));
    }

    /**
     * @param int $articleId
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(int $articleId)
    {
        return response()->download($this->articleRepository->getFilePathById($articleId));
    }
}
