<?php

namespace App\Serializer;

use JMS\Serializer\Context;
use JMS\Serializer\VisitorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

class PaginatorHandler
{
    public function serializeSlidingPaginationToJson(
        VisitorInterface $visitor,
        PaginationInterface $pagination,
        array $type,
        Context $context
    ) {
        $page  = $pagination->getCurrentPageNumber();
        $limit = $pagination->getItemNumberPerPage();
        $total = $pagination->getTotalItemCount();

        $data = [
            'items' => (array) $pagination->getItems(),
            'meta'  => [
                'limit' => $limit,
                'page'  => $page,
                'count' => $total,
            ],
        ];

        return $visitor->visitArray($data, $type, $context);
    }
}
