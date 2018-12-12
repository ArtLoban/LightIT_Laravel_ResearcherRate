<?php

namespace App\Services\MoviePoster\Contracts;

use Illuminate\Support\Collection;

interface MoviePosterService
{
    /**
     * @return Collection|null
     */
    public function getMovies(): ?Collection;
}
