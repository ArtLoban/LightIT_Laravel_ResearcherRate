<?php

namespace App\Http\Controllers\Admin\Publications;

use App\Http\Controllers\Controller;
use App\Models\Publications\Author;
use App\Services\Publications\Author\Repository\Contracts\Repository as AuthorRepository;
use Illuminate\Database\Eloquent\Builder;

class AuthorController extends Controller
{
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * AuthorController constructor.
     * @param $authorRepository
     */
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index()
    {
        $authors = Author::withCount(['articles' => function (Builder $query) {
            $query->where([
                ['year', '=', 2016],
            ]);
        }])->having('articles_count', '>', 2)->get();

        dd($authors);

        dd($authors->filter(function (Author $author) {
            return $author->articles()->where('year', '=', 2016)->get()->count() > 2;
        })->pluck('id'));



        return view('admin.publications.authors.index')
            ->with(['authors' => $this->authorRepository->allWithRelations(['profile'])]);
    }
}
