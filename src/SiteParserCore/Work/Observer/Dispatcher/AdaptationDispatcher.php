<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Observer\Dispatcher;

use App\SiteParserCore\Business\Event\Adaptation\AfterEvent;
use App\SiteParserCore\Business\Event\Adaptation\BeforeEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\SiteParserCore\Resource\Marker\Observer\Dispatcher\AdaptationInterface;
use App\SiteParserCore\Work\Factory\Event\AdaptationEventFactory;

class AdaptationDispatcher implements AdaptationInterface
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function dispatchBefore(): ?BeforeEvent
    {
        $event = $this->eventDispatcher->dispatch(AdaptationEventFactory::createBefore(), BeforeEvent::NAME);

        if (! $event instanceof BeforeEvent) {
            return null;
        }

        return $event;
    }

    public function dispatchAfter(): ?AfterEvent
    {
        $event = $this->eventDispatcher->dispatch(AdaptationEventFactory::createAfter(), AfterEvent::NAME);

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
