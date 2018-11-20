<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\Journal\StoreRequest;
use App\Services\Publications\Journal\Repository\Contracts\Repository as JournalRepository;

class JournalController extends Controller
{

    private $journalRepository;


    public function __construct(JournalRepository $journalRepository)
    {
        $this->journalRepository = $journalRepository;
    }

    public function store(StoreRequest $request)
    {
        $this->journalRepository->create($request->all());

        return response()->json(['msg' => 'The new journal is added!']);
    }
}
