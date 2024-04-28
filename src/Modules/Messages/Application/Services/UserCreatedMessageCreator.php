<?php

namespace App\Modules\Messages\Application\Services;

use App\Modules\Messages\Domain\Models\Message;
use App\Modules\Messages\Domain\Repositories\MessageRepository;
use App\Modules\Users\Domain\Events\UserCreatedDomainEvent;
use Exception;
use Psr\Log\LoggerInterface;

class UserCreatedMessageCreator
{
    public function __construct(
        private LoggerInterface $logger,
        private MessageRepository $repository
    ){}

    public function __invoke(UserCreatedDomainEvent $event): void
    {
        $this->logger->info(sprintf('Handling user created domain event %s', $event->getEventId()));

        $message = Message::create($event->getEventId(), $event->getEventName(), $event->getAttributes());

        try {
            $this->repository->save($message);
        }catch (Exception $exception) {
            $this->logger->error(sprintf('Error handling user created event %s: %s', $event->getEventId(), $exception->getMessage()));
        }
    }
}