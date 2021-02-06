<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Observer\Subscriber\Execution;

use App\SiteParserCore\Business\Event\Execution\AfterEvent;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\SubscriberInterface;

class AfterEventSubscriber implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            AfterEvent::class => 'subscribe'
        ];
    }

    /**
     * @param AfterEvent $event
     */
    public function subscribe(EventInterface $event): void
    {
    }
}