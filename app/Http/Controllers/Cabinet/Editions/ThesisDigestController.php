<?php

namespace App\Http\Controllers\Cabinet\Editions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\Editions\ThesisDigest\StoreRequest;
use App\Services\Publications\Theses\ThesisDigest\Repository\Contracts\Repository as ThesisDigestRepository;

class ThesisDigestController extends Controller
{
    /**
     * @var ThesisDigestRepository
     */
    private $thesisDigestRepository;

    /**
     * ThesisDigestController constructor.
     * @param ThesisDigestRepository $thesisDigestRepository
     */
    public function __construct(ThesisDigestRepository $thesisDigestRepository)
    {
        $this->thesisDigestRepository = $thesisDigestRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->thesisDigestRepository->create($request->all());

        return redirect()->back()->with('status', 'The new digest is added!');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function digestsNamesByAjaxAutocomplete(Request $request)
    {
        $result = $this->thesisDigestRepository->getDigestsNamesLikeQuery($request->get('name'));

        return response()->json($result);
    }
}
