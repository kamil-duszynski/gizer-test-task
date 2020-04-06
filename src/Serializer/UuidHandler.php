<?php

namespace App\Serializer;

use JMS\Serializer\VisitorInterface;
use Ramsey\Uuid\UuidInterface;

class UuidHandler
{
    public function serializeUuidV4ToJson(
        VisitorInterface $visitor,
        UuidInterface $uuid
    ) {
        return $visitor->getResult($uuid->toString());
    }
}
