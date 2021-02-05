<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Observer\Dispatcher\Parsing;

use App\DatabaseComponent\Business\Event\Parsing\BeforeEvent;
use App\DatabaseComponent\Resource\Marker\DispatcherInterface;
use App\DatabaseComponent\Work\Factory\Event\Parsing\BeforeEventFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class BeforeEventDispatcher implements DispatcherInterface
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function dispatch(): ?BeforeEvent
    {
        $event = $this->eventDispatcher->dispatch(BeforeEventFactory::create(), BeforeEvent::NAME);

        if (! $event instanceof BeforeEvent) {
            return null;
        }

        return $event;
    }
}
