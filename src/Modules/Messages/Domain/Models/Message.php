<?php

namespace App\Modules\Messages\Domain\Models;


use App\Modules\Shared\Application\Services\Uuid;
use DateTime;

class Message
{
    private string $id;

    private string $eventId;

    private string $eventName;

    private string $attributes;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    public function __construct(string $eventId, string $eventName, string $attributes)
    {
        $this->id = Uuid::generate();
        $this->eventId = $eventId;
        $this->eventName = $eventName;
        $this->attributes = $attributes;
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public static function create(string $eventId, string $eventName, string $attributes): self
    {
        return new self($eventId, $eventName, $attributes);
    }
}