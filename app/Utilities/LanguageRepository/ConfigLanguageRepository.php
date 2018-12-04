<?php

namespace App\Utilities\LanguageRepository;

use Illuminate\Config\Repository as ConfigRepository;
use App\Utilities\LanguageRepository\Contracts\Repository;

class ConfigLanguageRepository implements Repository
{
    /**
     * @var ConfigRepository
     */
    private $configRepository;

    /**
     * ConfigLanguageRepository constructor.
     * @param ConfigRepository $configRepository
     */
    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * @return array
     */
    public function all(): ?array
    {
        return $this->getData();
    }

    /**
     * @return array|null
     */
    private function getData(): ?array
    {
        $languageCodesData = $this->configRepository->get('utilities.languages');

        return ($languageCodesData && is_array($languageCodesData)) ? $languageCodesData : null;
    }
}
