<?php

namespace App\Modules\Users\Domain\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UserNotExistsException extends HttpException
{
    public function __construct(string $id)
    {
        $message = sprintf('User with id %s not exists', $id);
        parent::__construct(400, $message);
    }
}