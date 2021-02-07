<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Observer\Dispatcher;

use App\SiteParserCore\Business\Event\Parsing\BeforeEvent;
use App\SiteParserCore\Business\Event\Parsing\AfterEvent;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Marker\Observer\Dispatcher\ParsingInterface;
use App\SiteParserCore\Work\Factory\Event\Parsing\BeforeEventFactory;
use App\SiteParserCore\Work\Factory\Event\Parsing\AfterEventFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ParsingDispatcher implements ParsingInterface
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function dispatchBefore(Source $source, Destination $destination): ?BeforeEvent
    {
        $event = BeforeEventFactory::create($source, $destination);
        $event = $this->eventDispatcher->dispatch($event, BeforeEvent::NAME);

        if (! $event instanceof BeforeEvent) {
            return null;
        }

        return $event;
    }

    public function dispatchAfter(Source $source, Destination $destination): ?AfterEvent
    {
        $event = AfterEventFactory::create($source, $destination);
        $event = $this->eventDispatcher->dispatch($event, AfterEvent::NAME);

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
