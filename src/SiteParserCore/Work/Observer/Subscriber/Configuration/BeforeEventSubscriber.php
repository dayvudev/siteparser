<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Observer\Subscriber\Configuration;

use App\SiteParserCore\Business\Event\Configuration\BeforeEvent;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\Observer\SubscriberInterface;

class BeforeEventSubscriber implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEvent::class => 'subscribe'
        ];
    }

    /**
     * @param BeforeEvent $event
     */
    public function subscribe(EventInterface $event): void
    {
    }
}
