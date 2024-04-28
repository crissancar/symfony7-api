<?php

namespace App\Modules\Users\Application\Services;

use App\Modules\Shared\Application\Services\Uuid;
use App\Modules\Users\Application\DTO\CreateUserRequest;
use App\Modules\Users\Domain\Events\UserCreatedDomainEvent;
use App\Modules\Users\Domain\Exceptions\UserAlreadyExistsException;
use App\Modules\Users\Domain\Models\User;
use App\Modules\Users\Domain\Repositories\UserRepository;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class UserCreator
{
    public function __construct(
        private LoggerInterface $logger,
        private MessageBusInterface $messageBus,
        private UserRepository $repository
    ){}

    public function __invoke(CreateUserRequest $request): void
    {
        $user = User::create(Uuid::generate(), $request->name, $request->email, $request->password);

        try {
            $this->repository->save($user);

            $this->messageBus->dispatch(UserCreatedDomainEvent::create($user));
        }catch (Exception $exception) {
            $this->logger->error($exception->getMessage());

            if($exception->getCode() === 1062 ){
                throw new UserAlreadyExistsException($request->email);
            }

            throw $exception;
        }
    }
}