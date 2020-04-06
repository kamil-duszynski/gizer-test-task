<?php

namespace App\Model;

use DateTimeInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Ramsey\Uuid\UuidInterface;
use JMS\Serializer\Annotation as JMS;
use Swagger\Annotations as SWG;

class Score
{
    /**
     * @var UuidInterface
     *
     * @JMS\Groups({"score.list"})
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
     * @var User
     *
     * @JMS\Groups({"score.list"})
     *
     * @SWG\Property(
     *     property="user",
     *     type="object",
     *     description="User object",
     *     ref=@Model(type=User::class)
     * )
     */
    private User $user;

    /**
     * @var int
     *
     * @JMS\Groups({"score.list"})
     *
     * @SWG\Property(
     *     property="score",
     *     type="int",
     *     description="Score",
     *     example=20
     * )
     */
    private int $score;

    /**
     * @var DateTimeInterface
     *
     * @JMS\Groups({"score.list"})
     * @JMS\Type("DateTimeImmutable<'Y-m-d H:i:s'>")
     *
     * @SWG\Property(
     *     property="finished_at",
     *     type="string",
     *     description="Date of score",
     *     example="2020-04-06 00:00:00"
     * )
     */
    private DateTimeInterface $finishedAt;

    public function __construct(UuidInterface $id, User $user, int $score, DateTimeInterface $finishedAt)
    {
        $this->id         = $id;
        $this->user       = $user;
        $this->score      = $score;
        $this->finishedAt = $finishedAt;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getFinishedAt(): DateTimeInterface
    {
        return $this->finishedAt;
    }
}
