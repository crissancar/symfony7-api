<?php

declare(strict_types=1);

namespace App\Modules\Users\Infrastructure\Controllers;

use App\Modules\Users\Application\DTO\CreateUserRequest;
use App\Modules\Users\Application\Services\UserCreator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class UserPostController
{
    public function __construct(private UserCreator $creator){}

    #[Route('/users', name: 'user_create', methods: ['POST'])]
    public function index(#[MapRequestPayload] CreateUserRequest $request): Response
    {
        $this->creator->__invoke($request);

        return new Response('', Response::HTTP_CREATED);
    }
}
