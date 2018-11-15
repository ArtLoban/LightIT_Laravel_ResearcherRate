<?php

namespace App\Http\Controllers\Cabinet;

use App\Services\Utilities\LanguageRepository\Contracts\Repository as LanguageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Publications\PublicationType\Repository\Contracts\Repository as PublicationTypeRepository;

class ArticleController extends Controller
{
    /**
     * Show the application main page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cabinet.publications.scientific.articles.index');
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

    public function store(Request $request)
    {
        dd($request->input());
        return 'Stored!';
    }
}
