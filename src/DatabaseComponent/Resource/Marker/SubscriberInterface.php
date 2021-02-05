<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Marker;

use App\DatabaseComponent\Business\Event\EventInterface;
use App\DatabaseComponent\Work\Observer\ObserverInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

interface SubscriberInterface extends MarkerInterface, ObserverInterface, EventSubscriberInterface
{
    public function subscribe(EventInterface $event): void;
}
