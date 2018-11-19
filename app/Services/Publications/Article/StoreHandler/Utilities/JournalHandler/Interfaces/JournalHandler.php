<?php

namespace App\Services\Publications\Article\StoreHandler\Utilities\JournalHandler\Interfaces;

interface JournalHandler
{
    /**
     * @param string $journalName
     * @return int
     */
    public function getId(string $journalName): int;
}
