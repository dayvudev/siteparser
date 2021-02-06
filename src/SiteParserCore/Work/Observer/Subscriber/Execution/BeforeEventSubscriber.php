<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Observer\Subscriber\Execution;

use App\SiteParserCore\Business\Event\Execution\BeforeEvent;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\Observer\SubscriberInterface;
use Exception;

class BeforeEventSubscriber implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEvent::NAME => static::SUBSCRIBER_METHOD
        ];
    }

    /**
     * @param BeforeEvent $event
     */
    public function subscribe(EventInterface $event): void
    {
    }
}
