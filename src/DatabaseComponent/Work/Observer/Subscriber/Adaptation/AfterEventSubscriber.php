<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Observer\Subscriber\Adaptation;

use App\DatabaseComponent\Business\Event\Adaptation\AfterEvent;
use App\DatabaseComponent\Business\Event\EventInterface;
use App\DatabaseComponent\Resource\Marker\SubscriberInterface;

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
