<?php

namespace App\Storage;

use App\Client\ScoreClient;
use App\Model\Score;
use App\Service\OrderManager;

class ScoreStorage extends AbstractCacheStorage
{
    private ScoreClient $client;
    private OrderManager $orderManager;

    /**
     * @var Score[]
     */
    private array $scores = [];

    public function __construct(ScoreClient $client, OrderManager $orderManager)
    {
        $this->client       = $client;
        $this->orderManager = $orderManager;
    }

    public function load(): self
    {
        $cacheKey     = self::createCacheKey([ 'scores' ]);
        $this->scores = $this->loadFromCache($cacheKey);

        if (true === empty($this->scores)) {
            $this->scores = $this->client->getScores();

            // store to cache for performance optimizations
            $this->storeToCache($cacheKey, $this->scores);
        }

        return $this;
    }

    public function sort(?string $order = OrderManager::SORT_BY_DATE_ASC): self
    {
        if (true === empty($this->scores)) {
            return $this;
        }

        $this->scores = $this->orderManager->sort(
            $this->scores,
            $order
        );

        return $this;
    }

    /**
     * @return Score[]
     */
    public function getAll(): array
    {
        return $this->scores;
    }
}
