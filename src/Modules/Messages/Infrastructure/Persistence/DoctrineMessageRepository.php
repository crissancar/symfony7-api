<?php

namespace App\Modules\Messages\Infrastructure\Persistence;

use App\Modules\Messages\Domain\Models\Message;
use App\Modules\Messages\Domain\Repositories\MessageRepository;
use App\Modules\Shared\Infrastructure\Persistence\DoctrineRepository;

class DoctrineMessageRepository extends DoctrineRepository implements MessageRepository
{

    public function save(Message $message): void
    {
        $this->persist($message);
    }
}