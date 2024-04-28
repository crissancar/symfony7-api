<?php

namespace App\Modules\Users\Infrastructure\Persistence\Doctrine;

use App\Modules\Shared\Application\Services\Hasher;
use App\Modules\Users\Domain\Models\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: User::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: User::class)]
class UserEntitySubscriber
{
    public function prePersist(User $user): void
    {
        $hashedPassword = Hasher::hash($user->getPassword());

        $user->updatePassword($hashedPassword);
    }

    public function preUpdate(User $user, PreUpdateEventArgs $args): void
    {
        if ($args->hasChangedField('password')) {
            $hashedPassword = Hasher::hash($user->getPassword());

            $user->updatePassword($hashedPassword);
        }

        $user->updateTimestamps();
    }
}