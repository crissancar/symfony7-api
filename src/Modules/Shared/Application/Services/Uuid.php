<?php

namespace App\Modules\Shared\Application\Services;

use Symfony\Component\Uid\Uuid as SymfonyUuid;

class Uuid
{
    public static function generate(): string
    {
        return SymfonyUuid::v4()->toRfc4122();
    }
}