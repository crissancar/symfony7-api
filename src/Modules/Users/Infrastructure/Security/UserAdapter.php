<?php

namespace App\Modules\Users\Infrastructure\Security;

use App\Modules\Users\Domain\Models\User as DomainUser;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserAdapter implements UserInterface, PasswordAuthenticatedUserInterface
{
    private DomainUser $user;

    public function __construct(DomainUser $user)
    {
        $this->user = $user;
    }

    public function getUsername(): string
    {
        return $this->user->getEmail();
    }

    public function getRoles(): array
    {
        return $this->user->getRoles();
    }

    public function getPassword(): string
    {
        return $this->user->getPassword();
    }

    public function getSalt(): null
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }

    public function getDomainUser(): DomainUser
    {
        return $this->user;
    }

    public function getUserIdentifier(): string
    {
        return $this->user->getEmail();
    }

    public function updatePassword(string $hashedPassword): void
    {
        $this->user->updatePassword($hashedPassword);
    }
}