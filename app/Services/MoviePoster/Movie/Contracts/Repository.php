<?php

namespace App\Services\MoviePoster\Movie\Contracts;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @return Collection|null
     */
    public function getAllForCurrentDay(Carbon $carbon): ?Collection;
}
