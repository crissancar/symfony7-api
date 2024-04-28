<?php

namespace App\Modules\Users\Domain\Events;

use App\Modules\Shared\Application\Services\Uuid;
use App\Modules\Users\Domain\Models\User;
use DateTime;

class UserCreatedDomainEvent
{
    private string $eventId;

    private string $eventName;

    private DateTime $occurred_on;

    private string $attributes;

    public function __construct(User $user)
    {
        $this->eventId = Uuid::generate();
        $this->eventName = 'user.created';
        $this->occurred_on = new DateTime();
        $this->attributes = $this->serializeAttributes($user);
    }

    public static function create(User $user): self
    {
        return new self($user);
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public function getAttributes(): string
    {
        return $this->attributes;
    }

    private function serializeAttributes(User $user): string
    {
        return json_encode([
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ], JSON_THROW_ON_ERROR);
    }
}