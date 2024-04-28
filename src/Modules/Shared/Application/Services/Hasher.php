<?php

namespace App\Modules\Shared\Application\Services;

use Symfony\Component\PasswordHasher\Hasher\NativePasswordHasher;

class Hasher
{
    public static function hash(string $plainValue): string
    {
        return (new NativePasswordHasher())->hash($plainValue);
    }
}