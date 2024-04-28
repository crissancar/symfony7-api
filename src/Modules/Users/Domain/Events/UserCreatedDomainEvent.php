<?php

namespace App\Modules\Users\Domain\Events;

use App\Modules\Shared\Application\Services\Uuid;
use App\Modules\Users\Domain\Models\User;
use DateTime;

class UserCreatedDomainEvent
{
    private string $eventId;

    private DateTime $occurred_on;

    private object $attributes;

    public function __construct(object $attributes)
    {
        $this->eventId = Uuid::generate();
        $this->occurred_on = new DateTime();
        $this->attributes = $attributes;
    }

    public static function create(User $user): self
    {
        return new self($user);
    }
}