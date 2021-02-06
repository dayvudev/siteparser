<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Observer\Dispatcher\Execution;

use App\SiteParserCore\Business\Event\Execution\BeforeEvent;
use App\SiteParserCore\Resource\Marker\Observer\DispatcherInterface;
use App\SiteParserCore\Work\Factory\Event\Execution\BeforeEventFactory;
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

    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->eventDispatcher;
    }
}
