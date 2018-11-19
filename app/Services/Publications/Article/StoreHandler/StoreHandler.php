<?php

namespace App\Services\Publications\Article\StoreHandler;

use App\Services\Publications\Article\StoreHandler\Contracts\StoreHandlerInterface;
use App\Services\Publications\Article\StoreHandler\Utilities\AuthorsHandler\Interfaces\AuthorsHandler;
use App\Services\Publications\Article\StoreHandler\Utilities\JournalHandler\Interfaces\JournalHandler;
use Illuminate\Database\Eloquent\Model;

class StoreHandler implements StoreHandlerInterface
{
    /**
     * @var JournalHandler
     */
    private $journalHandler;

    /**
     * @var AuthorsHandler
     */
    private $authorsHandler;

    public function __construct(JournalHandler $journalHandler, AuthorsHandler $authorsHandler)
    {
        $this->journalHandler = $journalHandler;
        $this->authorsHandler = $authorsHandler;
    }

    /**
     * @param string $journalName
     * @return int
     */
    public function getJournalId(string $journalName): int
    {
        return $this->journalHandler->getId($journalName);
    }

    public function assignAuthors(string $authors, Model $article)
    {
        $this->authorsHandler->assign($authors, $article);
    }
}
