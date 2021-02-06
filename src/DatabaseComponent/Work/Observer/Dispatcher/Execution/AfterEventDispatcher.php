<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Observer\Dispatcher\Execution;

use App\DatabaseComponent\Business\Event\Execution\AfterEvent;
use App\DatabaseComponent\Resource\Marker\DispatcherInterface;
use App\DatabaseComponent\Work\Factory\Event\Execution\AfterEventFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class AfterEventDispatcher implements DispatcherInterface
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function dispatch(): ?AfterEvent
    {
        $event = $this->eventDispatcher->dispatch(AfterEventFactory::create(), AfterEvent::NAME);

        if (! $event instanceof AfterEvent) {
            return null;
        }

        return $event;
    }
}