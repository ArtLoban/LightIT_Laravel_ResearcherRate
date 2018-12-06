<?php

namespace App\Http\Controllers\Admin\Publications;

use App\Http\Controllers\Controller;
use App\Models\Publications\Articles\Article;
use App\Http\Requests\Cabinet\Publications\Article\StoreRequest;
use App\Http\Requests\Cabinet\Publications\Article\UpdateRequest;
use App\Utilities\LanguageRepository\Contracts\Repository as LanguageRepository;
use App\Services\Publications\Services\PublicationStorage\Contracts\PublicationStorageInterface;
use App\Services\Publications\Articles\Journal\Repository\Contracts\Repository as JournalRepository;
use App\Services\Publications\Articles\Article\Repository\Contracts\Repository as ArticleRepository;
use App\Services\Publications\Articles\JournalType\Repository\Contracts\Repository as JournalTypeRepository;
use App\Services\Publications\PublicationType\Repository\Contracts\Repository as PublicationTypeRepository;

class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var JournalRepository
     */
    private $journalRepository;

    /**
     * @var PublicationTypeRepository
     */
    private $publicationTypeRepository;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(
        ArticleRepository $articleRepository,
        JournalRepository $journalRepository,
        PublicationTypeRepository $publicationTypeRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->publicationTypeRepository = $publicationTypeRepository;
        $this->journalRepository = $journalRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.publications.articles.index')
            ->with(['articles' => $this->articleRepository->allWithRelations(['journal', 'authors', 'publicationType'])]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(LanguageRepository $languageRepository, JournalTypeRepository $journalTypeRepository)
    {
        return view('admin.publications.articles.create')
            ->with([
                'publicationTypes' => $this->publicationTypeRepository->all(),
                'languages' => $languageRepository->all(),
                'journalTypes' => $journalTypeRepository->all(),
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
            'journal_name',
            'journal_id',
            $this->articleRepository,
            $this->journalRepository
        );

        return redirect()->route('articles.index');
    }

    /**
     * @param Article $article
     * @param LanguageRepository $languageRepository
     * @param JournalTypeRepository $journalTypeRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(
        Article $article,
        LanguageRepository $languageRepository,
        JournalTypeRepository $journalTypeRepository
    ) {
        return view('admin.publications.articles.edit')
            ->with([
                'article' => $article,
                'languages' => $languageRepository->all(),
                'journalTypes' => $journalTypeRepository->all(),
                'publicationTypes' => $this->publicationTypeRepository->all()
            ]);
    }

    /**
     * @param UpdateRequest $request
     * @param int $articleId
     * @param PublicationStorageInterface $publicationStorage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $articleId, PublicationStorageInterface $publicationStorage)
    {
        $publicationStorage->update(
            $request->all(),
            $articleId,
            'journal_name',
            'journal_id',
            $this->articleRepository,
            $this->journalRepository
        );

        return redirect()->route('articles.index');
    }

    /**
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        $this->articleRepository->delete($article);

        return redirect()->route('articles.index');
    }
}
