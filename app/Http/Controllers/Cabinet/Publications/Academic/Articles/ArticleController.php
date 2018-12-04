<?php

namespace App\Http\Controllers\Cabinet\Publications\Academic\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\Article\StoreRequest;
use App\Http\Requests\Cabinet\Article\UpdateRequest;
use App\Models\Publications\Articles\Article\Article;
use Illuminate\Contracts\Auth\Guard as Auth;
use App\Services\Utilities\PublicationStorage\Contracts\PublicationStorageInterface;
use App\Services\Publications\Author\Repository\Contracts\Repository as AuthorRepository;
use App\Services\Utilities\LanguageRepository\Contracts\Repository as LanguageRepository;
use App\Services\Publications\Journal\Repository\Contracts\Repository as JournalRepository;
use App\Services\Publications\Article\Repository\Contracts\Repository as ArticleRepository;
use App\Services\Publications\JournalType\Repository\Contracts\Repository as JournalTypeRepository;
use App\Services\Publications\PublicationType\Repository\Contracts\Repository as PublicationTypeRepository;

class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var AuthorRepository
     */
    private $authorRepository;

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
     * @param AuthorRepository $authorRepository
     * @param JournalRepository $journalRepository
     */
    public function __construct(
        ArticleRepository $articleRepository,
        AuthorRepository $authorRepository,
        JournalRepository $journalRepository,
        PublicationTypeRepository $publicationTypeRepository
    ) {
        $this->articleRepository = $articleRepository;
        $this->authorRepository = $authorRepository;
        $this->journalRepository = $journalRepository;
        $this->publicationTypeRepository = $publicationTypeRepository;
    }

    public function index(Auth $auth)
    {
        $publicationTypeId = $this->publicationTypeRepository->getAcademicId();
        $articles = $this->articleRepository->getAllWithRelationsByUserIdAndType($auth->id(), $publicationTypeId);

        return view('cabinet.publications.academic.articles.index', ['articles' => $articles]);
    }

    /**
     * @param PublicationTypeRepository $publicationTypeRepository
     * @param LanguageRepository $languageRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(LanguageRepository $languageRepository, JournalTypeRepository $journalTypeRepository)
    {
        return view('cabinet.publications.academic.articles.create')
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

        return redirect()->route('academic.articles.index')->with('status', 'The new article is added!');
    }

    /**
     * @param $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $articleId)
    {
        $article = $this->articleRepository->getWithRelationsById($articleId, ['journal', 'authors', 'publicationType']);

        return view('cabinet.publications.academic.articles.show', ['article' => $article]);
    }

    /**
     * @param Article $article
     * @param LanguageRepository $languageRepository
     * @param JournalTypeRepository $journalTypeRepository
     * @param PublicationTypeRepository $publicationTypeRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(
        Article $article,
        LanguageRepository $languageRepository,
        JournalTypeRepository $journalTypeRepository
    ) {
        return view('cabinet.publications.academic.articles.edit')
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

        return redirect()->route('academic.articles.show', $articleId)->with('status', 'The article is updated!');
    }

    /**
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        $this->articleRepository->delete($article);

        return redirect()->route('academic.articles.index')->with('status', 'The article has been deleted!');
    }
}