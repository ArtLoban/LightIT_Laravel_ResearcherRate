<?php

namespace App\Http\Controllers\Cabinet\Publications;

use Illuminate\Http\Request;

use App\Services\Publications\Author\Repository\Contracts\Repository as AuthorRepository;

class AuthorController
{
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * AuthorController constructor.
     * @param AuthorRepository $authorRepository
     */
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authorsAjax(Request $request)
    {
        $result = $this->authorRepository->getAuthorNamesByAjaxQuery($request->get('name'));

        return response()->json($result);
    }
}
