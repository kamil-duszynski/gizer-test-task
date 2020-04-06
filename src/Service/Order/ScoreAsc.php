<?php

namespace App\Service\Order;

use App\Model\Score;
use App\Service\OrderManager;

class ScoreAsc implements OptionInterface
{
    public function getValue(): string
    {
        return OrderManager::SORT_BY_SCORE_ASC;
    }

    public function sort(array $scores): array
    {
        usort(
            $scores,
            function (Score $scoreA, Score $scoreB) {
                $scoreA = $scoreA->getScore();
                $scoreB = $scoreB->getScore();

                return $scoreA > $scoreB;
            }
        );

        return $scores;
    }
}
