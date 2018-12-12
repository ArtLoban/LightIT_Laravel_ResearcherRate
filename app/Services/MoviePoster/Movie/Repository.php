<?php

namespace App\Services\MoviePoster\Movie;

use Carbon\Carbon;
use App\Models\MoviePoster\Movie;
use Illuminate\Support\Collection;
use App\Utilities\Repository\RepositoryAbstract;
use \App\Services\MoviePoster\Movie\Contracts\Repository as MovieRepository;

class Repository extends RepositoryAbstract implements MovieRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Movie::class;
    }

    /**
     * @param Carbon $carbon
     * @return Collection|null
     */
    public function getAllForCurrentDay(Carbon $carbon): ?Collection
    {
        return $this->className::where('date', $this->getCurrentDate($carbon))->get();
    }

    /**
     * @param Carbon $carbon
     * @return string
     */
    private function getCurrentDate(Carbon $carbon): string
    {
        return $carbon->today()->format('Y-m-d');
    }
}
