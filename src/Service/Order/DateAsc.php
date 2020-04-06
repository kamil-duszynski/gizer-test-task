<?php

namespace App\Service\Order;

use App\Model\Score;
use App\Service\OrderManager;

class DateAsc implements OptionInterface
{
    public function getValue(): string
    {
        return OrderManager::SORT_BY_DATE_ASC;
    }

    /**
     * {@inheritdoc}
     */
    public function sort(array $scores): array
    {
        usort(
            $scores,
            function (Score $scoreA, Score $scoreB) {
                $dateA = $scoreA->getFinishedAt();
                $dateB = $scoreB->getFinishedAt();

                return $dateA > $dateB;
            }
        );

        return $scores;
    }
}
