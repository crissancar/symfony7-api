<?php

namespace App\Modules\Users\Application\Services;

use App\Modules\Users\Domain\Exceptions\UserNotExistsException;
use App\Modules\Users\Domain\Models\User;
use App\Modules\Users\Domain\Repositories\UserRepository;

final class UserFinder
{
    public function __construct(private UserRepository $repository){}

    public function __invoke(string $id): User
    {
        $foundUser = $this->repository->find($id);

        if(!$foundUser){
            throw new UserNotExistsException($id);
        }

        return $foundUser;
    }
}