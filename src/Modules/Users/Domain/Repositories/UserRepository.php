<?php

namespace App\Modules\Users\Domain\Repositories;

use App\Modules\Users\Domain\Models\User;

interface UserRepository
{
    public function save(User $user): void;

    public function find(string $id): ?User;
}