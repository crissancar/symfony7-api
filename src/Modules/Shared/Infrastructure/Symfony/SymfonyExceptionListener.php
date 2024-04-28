<?php

namespace App\Modules\Shared\Infrastructure\Symfony;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use function get_class;
use function time;

class SymfonyExceptionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $status = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
        $message = $exception->getMessage();
        $context = get_class($exception);

        $data = [
            'status' => $status,
            'message' => $message,
            'context' => $context,
        ];

        $response = new JsonResponse($data);
        $response->headers->set('Server-Time', time());
        $response->headers->set('X-Error-Code', $status);

        $event->setResponse($response);
    }
}