<?php

namespace App\Http\Controllers\Cabinet\Editions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Publications\Patents\PatentBulletin\Repository\Contracts\Repository as PatentBulletinRepository;

class PatentBulletinController extends Controller
{
    /**
     * @var PatentBulletinRepository
     */
    private $patentBulletinRepository;

    /**
     * PatentBulletinController constructor.
     * @param PatentBulletinRepository $patentBulletinRepository
     */
    public function __construct(PatentBulletinRepository $patentBulletinRepository)
    {
        $this->patentBulletinRepository = $patentBulletinRepository;
    }


    public function store(Request $request)
    {
        $this->patentBulletinRepository->create($request->all());

        return redirect()->back()->with('status', 'The new patent bulletin publication is added!');
    }
}
