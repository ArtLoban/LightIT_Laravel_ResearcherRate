<?php

namespace App\Services\MoviePoster;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Services\MoviePoster\Contracts\MoviePosterService;
use App\Services\MovieParser\Contracts\MovieParserInterface;
use App\Services\MoviePoster\Movie\Contracts\Repository as MovieRepository;

class MoviePoster implements MoviePosterService
{
    /**
     * @var MovieRepository
     */
    private $movieRepository;

    /**
     * @var MovieParserInterface
     */
    private $movieParser;

    /**
     * @var Carbon
     */
    private $carbon;

    /**
     * MoviePoster constructor.
     * @param MovieParserInterface $movieParser
     */
    public function __construct(MovieRepository $movieRepository, MovieParserInterface $movieParser, Carbon $carbon)
    {
        $this->movieParser = $movieParser;
        $this->movieRepository = $movieRepository;
        $this->carbon = $carbon;
    }

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getMovies(): ?Collection
    {
        $currentDayMovies = $this->movieRepository->getAllForCurrentDay($this->carbon);

        return $currentDayMovies->isNotEmpty() ? $currentDayMovies : $this->getFreshData();
    }

    /**
     * @return \Illuminate\Support\Collection|null
     */
    private function getFreshData()
    {
        $parsedData = $this->parseData();
        $this->createNewRecords($parsedData);

        return $this->movieRepository->getAllForCurrentDay($this->carbon);
    }

    /**
     * @return array
     */
    private function parseData(): array
    {
        return $parsedData = $this->movieParser->getData();
    }

    /**
     * @param array $parsedData
     * @return mixed
     */
    private function createNewRecords(array $parsedData): bool
    {
        return $this->movieRepository->insert($parsedData);
    }
}
