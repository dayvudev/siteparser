<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Observer\Subscriber\Configuration;

use App\SiteParserCore\Business\Event\Configuration\AfterEvent;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\Observer\SubscriberInterface;

class AfterEventSubscriber implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            AfterEvent::NAME => static::SUBSCRIBER_METHOD
        ];
    }

    /**
     * @param AfterEvent $event
     */
    public function subscribe(EventInterface $event): void
    {
    }
}
