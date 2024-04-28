<?php

declare(strict_types=1);

namespace App\Modules\Users\Infrastructure\Controllers;

use App\Modules\Users\Application\Services\UserFinder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserGetController
{
    public function __construct(private UserFinder $finder){}

    #[Route('/users/{id}', name: 'user_find', methods: ['GET'])]
    public function index(string $id): JsonResponse
    {
        $foundUser = $this->finder->__invoke($id);

        $response = [
            'id' => $foundUser->getId(),
            'name' => $foundUser->getName(),
            'email' => $foundUser->getEmail(),
            'createdAt' => $foundUser->getCreatedAt()->format('Y-m-d H:i:s'),
        ];

        return new JsonResponse($response, Response::HTTP_OK);
    }
}