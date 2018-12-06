<?php

namespace App\Http\Controllers\Admin\Publications\Editions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\Editions\Journal\StoreRequest;
use App\Services\Publications\Articles\Journal\Repository\Contracts\Repository as JournalRepository;
use App\Services\Publications\Articles\JournalType\Repository\Contracts\Repository as JournalTypeRepository;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.editions.journals.index')
            ->with(['journals' => $this->journalRepository->allWithRelations(['journalType'])]);
    }

    /**
     * @param JournalTypeRepository $journalTypeRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(JournalTypeRepository $journalTypeRepository)
    {
        return view('admin.editions.journals.create', ['journalTypes' => $journalTypeRepository->all()]);
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $this->journalRepository->create($request->all());

        return redirect()->route('admin.journals.index');
    }
}
