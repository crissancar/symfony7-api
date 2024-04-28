<?php

namespace App\Modules\Users\Domain\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UserAlreadyExistsException extends HttpException
{
    public function __construct(string $email)
    {
        $message = sprintf('User with email %s already exists', $email);
        parent::__construct(400, $message);
    }
}