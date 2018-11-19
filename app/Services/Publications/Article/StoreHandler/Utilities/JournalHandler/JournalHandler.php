<?php

namespace App\Services\Publications\Article\StoreHandler\Utilities\JournalHandler;

use App\Models\Publications\Articles\Journal\Journal;
use App\Services\Publications\Journal\Repository\Contracts\Repository as JournalRepository;
use App\Services\Publications\Article\StoreHandler\Utilities\JournalHandler\Interfaces\JournalHandler as JournalHandlerInterface;

class JournalHandler implements JournalHandlerInterface
{
    /**
     * @var JournalRepository
     */
    private $journalRepository;

    /**
     * StoreHandler constructor.
     * @param JournalRepository $journalRepository
     */
    public function __construct(JournalRepository $journalRepository)
    {
        $this->journalRepository = $journalRepository;
    }

    /**
     * Create new Journal if input value is string - journal name
     * If input value is integer - key of existing journal item, then find that model
     *
     * @param string $journalName
     * @return int
     */
    public function getId(string $journalName): int
    {
        if ($this->checkIfInteger($journalName)) {
            $journalItem = $this->getJournalById((int) $journalName);

            return $journalItem->getKey();
        }

        $journalItem = $this->createNewJournal($journalName);

        return $journalItem->getKey();
    }

    /**
     * @param string $value
     * @return bool
     */
    private function checkIfInteger(string $value): bool
    {
        $intValue = (int) $value; // text is being transformed into 0, number in integer value

        if (is_int($intValue) && $intValue !== 0) {
            return true;
        }

        return false;
    }

    /**
     * @param int $id
     * @return Journal|null
     */
    private function getJournalById(int $id): ?Journal
    {
        return $this->journalRepository->whereId($id);
    }

    /**
     * @param string $journalName
     * @return Journal
     */
    private function createNewJournal(string $journalName): Journal
    {
        return $this->journalRepository->create(['name' => $journalName]);
    }
}
