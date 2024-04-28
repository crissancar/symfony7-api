<?php

namespace App\Modules\Users\Infrastructure\Persistence;

use App\Modules\Shared\Infrastructure\Persistence\DoctrineRepository;
use App\Modules\Users\Domain\Models\User;
use App\Modules\Users\Domain\Repositories\UserRepository;

class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{
    public function save(User $user): void
    {
        $this->persist($user);
    }

    public function findById(string $id): ?User
    {
        return $this->repository(User::class)->find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->repository(User::class)->findOneBy(['email' => $email]);
    }
}