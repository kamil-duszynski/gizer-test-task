<?php

namespace App\Model;

use Ramsey\Uuid\UuidInterface;
use JMS\Serializer\Annotation as JMS;
use Swagger\Annotations as SWG;

class User
{
    /**
     * @var UuidInterface
     *
     * @JMS\Groups({"user.list"})
     *
     * @SWG\Property(
     *     property="id",
     *     type="string",
     *     description="Id of score record",
     *     example="9f891436-60b3-45fd-8a20-76952fc97b35"
     * )
     */
    private UuidInterface $id;

    /**
     * @var string
     *
     * @JMS\Groups({"user.list"})
     *
     * @SWG\Property(
     *     property="name",
     *     type="string",
     *     description="User name",
     *     example="Kamil Duszyński"
     * )
     */
    private string $name;

    public function __construct(UuidInterface $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
