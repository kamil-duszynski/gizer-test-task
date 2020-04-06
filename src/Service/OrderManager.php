<?php

namespace App\Service;

use App\Service\Order\OptionInterface;
use InvalidArgumentException;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

class OrderManager
{
    public const SORT_BY_DATE_ASC  = 'date.asc';
    public const SORT_BY_DATE_DESC = 'date.desc';
    public const SORT_BY_SCORE_ASC  = 'score.asc';
    public const SORT_BY_SCORE_DESC = 'score.desc';

    /**
     * @var OptionInterface[]
     */
    private array $options = [];

    public function addOption(OptionInterface $option): void
    {
        $this->options[get_class($option)] = $option;
    }

    /**
     * @return OptionInterface[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    public function sort(array $scores, string $order): array
    {
        $orderOption = $this->getOptionByOrder($order);

        if (null === $orderOption) {
            throw new InvalidArgumentException('Undefined sort type');
        }

        return $orderOption->sort($scores);
    }

    private function getOptionByOrder(string $order): ?OptionInterface
    {
        foreach($this->getOptions() as $option) {
            if ($option->getValue() !== $order) {
                continue;
            }

            return $option;
        }

        return null;
    }
}
