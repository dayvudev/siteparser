<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Observer\Subscriber\Execution;

use App\DatabaseComponent\Business\Event\Execution\BeforeEvent;
use App\DatabaseComponent\Business\Event\EventInterface;
use App\DatabaseComponent\Resource\Marker\SubscriberInterface;

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
