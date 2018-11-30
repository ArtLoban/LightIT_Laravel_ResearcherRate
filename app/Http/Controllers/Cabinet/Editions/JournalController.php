<?php

namespace App\Http\Controllers\Cabinet\Editions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\Editions\Journal\StoreRequest;
use App\Services\Publications\Journal\Repository\Contracts\Repository as JournalRepository;

class JournalController extends Controller
{
    /**
     * @var JournalRepository
     */
    private $journalRepository;

    /**
     * JournalController constructor.
     * @param JournalRepository $journalRepository
     */
    public function __construct(JournalRepository $journalRepository)
    {
        $this->journalRepository = $journalRepository;
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $this->journalRepository->create($request->all());

        return response()->json(['msg' => 'The new journal is added!']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function journalsAjax(Request $request)
    {
        $result = $this->journalRepository->getJournalNamesByAjaxQuery($request->get('name'));

        return response()->json($result);
    }
}