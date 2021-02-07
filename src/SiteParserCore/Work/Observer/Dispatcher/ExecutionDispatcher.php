<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Observer\Dispatcher;

use App\SiteParserCore\Business\Event\Execution\BeforeEvent;
use App\SiteParserCore\Business\Event\Execution\AfterEvent;
use App\SiteParserCore\Resource\Marker\Observer\Dispatcher\ExecutionInterface;
use App\SiteParserCore\Resource\Marker\Observer\DispatcherInterface;
use App\SiteParserCore\Work\Factory\Event\Execution\BeforeEventFactory;
use App\SiteParserCore\Work\Factory\Event\Execution\AfterEventFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ExecutionDispatcher implements ExecutionInterface
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function dispatchBefore(): ?BeforeEvent
    {
        $event = $this->eventDispatcher->dispatch(BeforeEventFactory::create(), BeforeEvent::NAME);

        if (! $event instanceof BeforeEvent) {
            return null;
        }

        return $event;
    }

    public function dispatchAfter(): ?AfterEvent
    {
        $event = $this->eventDispatcher->dispatch(AfterEventFactory::create(), AfterEvent::NAME);

        if (! $event instanceof AfterEvent) {
            return null;
        }

        return $event;
    }

    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->eventDispatcher;
    }
}
