<?php

namespace App\Factory;

use App\Model\Score;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScoreFactory
{
    public static function createFromArray(array $data): Score
    {
        $resolver = new OptionsResolver();
        $resolver
            ->setRequired(
                [
                    'id', 'user', 'score', 'finished_at',
                ]
            )
        ;

        $data = $resolver->resolve($data);
        $user = UserFactory::createFromArray($data['user']);

        return new Score(
            Uuid::fromString($data['id']),
            $user,
            $data['score'],
            new DateTimeImmutable($data['finished_at'])
        );
    }
}
