<?php

namespace App\Service\Order;

use App\Model\Score;

interface OptionInterface
{
    public function getValue(): string;

    /**
     * @param Score[] $scores
     *
     * @return Score[]
     */
    public function sort(array $scores): array;
}
