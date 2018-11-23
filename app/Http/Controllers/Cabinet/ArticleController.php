<?php

namespace App\Http\Controllers\Cabinet;

use App\Services\Utilities\PublicationStorage\Contracts\PublicationStorageInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard as Auth;
use App\Http\Requests\Cabinet\Article\StoreRequest;
use App\Http\Requests\Cabinet\Article\UpdateRequest;
use App\Models\Publications\Articles\Article\Article;
use Illuminate\Contracts\Filesystem\Filesystem as Storage;
use App\Http\Requests\Cabinet\Article\AuthorsAjaxRequest;
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
     * ArticleController constructor.
     * @param ArticleRepository $articleRepository
     * @param AuthorRepository $authorRepository
     * @param JournalRepository $journalRepository
     */
    public function __construct(
        ArticleRepository $articleRepository,
        AuthorRepository $authorRepository,
        JournalRepository $journalRepository
    ) {
        $this->articleRepository = $articleRepository;
        $this->authorRepository = $authorRepository;
        $this->journalRepository = $journalRepository;
    }

    /**
     * Show the application main page
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Auth $auth)
    {
        $articles = $this->articleRepository
            ->getAllWithRelationsBy('user_id', $auth->id(), ['journal', 'authors', 'publicationType']);

        return view('cabinet.publications.scientific.articles.index', ['articles' => $articles]);
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
     * @param Article $article
     * @param LanguageRepository $languageRepository
     * @param JournalTypeRepository $journalTypeRepository
     * @param PublicationTypeRepository $publicationTypeRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(
        Article $article,
        LanguageRepository $languageRepository,
        JournalTypeRepository $journalTypeRepository,
        PublicationTypeRepository $publicationTypeRepository
    ) {
        return view('cabinet.publications.scientific.articles.edit')
            ->with([
                'article' => $article,
                'languages' => $languageRepository->all(),
                'journalTypes' => $journalTypeRepository->all(),
                'publicationTypes' => $publicationTypeRepository->all()
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

        return redirect()->route('articles.show', $articleId)->with('status', 'The article is updated!');
    }

    /**
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        $this->articleRepository->delete($article);

        return redirect()->route('articles.index')->with('status', 'The article has been deleted!');
    }

    /**
     * @param int $articleId
     * @param Storage $storage
     */
    public function file(int $articleId, Storage $storage)
    {
        $file = $this->articleRepository->getFileById($articleId);
        if ($file && $storage->exists($file->getActualPath())) {
            return response()->file($file->path);
        }

        return response()->view('cabinet.errors.file_not_found');
    }

    /**
     * @param int $articleId
     * @param Storage $storage
     */
    public function download(int $articleId, Storage $storage)
    {
        $file = $this->articleRepository->getFileById($articleId);
        if ($file && $storage->exists($file->getActualPath())) {
            return response()->download($file->path);
        }

        return response()->view('cabinet.errors.file_not_found');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authors(Request $request)
    {
        $result = $this->authorRepository->getAuthorNamesByAjaxQuery($request->get('name'));

        return response()->json($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function journals(Request $request)
    {
        $result = $this->journalRepository->getJournalNamesByAjaxQuery($request->get('name'));

        return response()->json($result);
    }
}
