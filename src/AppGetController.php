<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AppGetController
{
    #[Route('/', name: 'hello_world', methods: ['GET'])]
    public function index(): Response
    {
        return new Response('Hello world!', Response::HTTP_OK);
    }
}
