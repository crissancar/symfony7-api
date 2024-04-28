<?php

namespace App\Modules\Users\Infrastructure\Security;

use App\Modules\Users\Domain\Repositories\UserRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function supportsClass(string $class): bool
    {
        return UserAdapter::class === $class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->findByEmail($identifier);

        if(!$user){
            throw new BadRequestException('User not found');
        }

        return new UserAdapter($user);
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        // TODO: Implement upgradePassword() method.
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof UserAdapter) {
            throw new UnsupportedUserException(\sprintf('Instances of %s are not supported', \get_class($user)));
        }

        return $this->loadUserByIdentifier($user->getUsername());
    }
}