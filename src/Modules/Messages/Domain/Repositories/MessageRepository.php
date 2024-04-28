<?php

namespace App\Modules\Messages\Domain\Repositories;

use App\Modules\Messages\Domain\Models\Message;

interface MessageRepository
{
    public function save(Message $message): void;
}