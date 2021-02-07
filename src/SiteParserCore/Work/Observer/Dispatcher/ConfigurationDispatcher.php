<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Observer\Dispatcher;

use App\SiteParserCore\Business\Event\Configuration\BeforeEvent;
use App\SiteParserCore\Business\Event\Configuration\AfterEvent;
use App\SiteParserCore\Resource\Marker\Observer\Dispatcher\ConfigurationInterface;
use App\SiteParserCore\Work\Factory\Event\Configuration\BeforeEventFactory;
use App\SiteParserCore\Work\Factory\Event\Configuration\AfterEventFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ConfigurationDispatcher implements ConfigurationInterface
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
