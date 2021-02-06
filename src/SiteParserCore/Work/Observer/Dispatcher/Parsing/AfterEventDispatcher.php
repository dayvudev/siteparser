<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Observer\Dispatcher\Parsing;

use App\SiteParserCore\Business\Event\Parsing\AfterEvent;
use App\SiteParserCore\Resource\Marker\DispatcherInterface;
use App\SiteParserCore\Work\Factory\Event\Parsing\AfterEventFactory;
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
