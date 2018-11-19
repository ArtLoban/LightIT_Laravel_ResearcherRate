<?php

namespace App\Services\Publications\Article\StoreHandler\Contracts;

interface StoreHandlerInterface
{
    /**
     * @param string $journalName
     * @return int
     */
    public function getJournalId(string $journalName): int;
}
