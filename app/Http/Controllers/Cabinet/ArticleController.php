<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Requests\Cabinet\Article\StoreRequest;
use App\Services\Publications\Article\Repository\Contracts\Repository as ArticleRepository;
use App\Services\Publications\Article\StoreHandler\Contracts\StoreHandlerInterface as StoreHandler;
use App\Services\Utilities\LanguageRepository\Contracts\Repository as LanguageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
                'articles' => $this->articleRepository->allWithRelations(['journal', 'publicationType'])
            ]);
    }

    /**
     * @param PublicationTypeRepository $publicationTypeRepository
     * @param LanguageRepository $languageRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(PublicationTypeRepository $publicationTypeRepository, LanguageRepository $languageRepository)
    {
        return view('cabinet.publications.scientific.articles.create')
            ->with([
                'publicationTypes' => $publicationTypeRepository->all(),
                'languages' => $languageRepository->all(),
            ]);
    }

    public function store(StoreRequest $request, StoreHandler $storeHandler)
    {

        $article = $this->articleRepository->createNewArticle($request->all(), $storeHandler);

//        $article = $this->articleRepository->create($request->all());
//        $article->authors()->attach($request->author_id);
//
//        if ($request->has('file')) {
//            $fileUploader->store($request->file('file'), $article);
//        }

        return redirect()->route('articles.index')->with('status', 'New article is added!');
    }
}
