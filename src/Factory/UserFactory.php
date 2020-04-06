<?php

namespace App\Factory;

use App\Model\User;
use Ramsey\Uuid\Uuid;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFactory
{
    public static function createFromArray(array $data): User
    {
        $resolver = new OptionsResolver();
        $resolver
            ->setRequired(
                [
                    'id', 'name',
                ]
            )
        ;

        $data = $resolver->resolve($data);

        return new User(
            Uuid::fromString($data['id']),
            $data['name']
        );
    }
}
