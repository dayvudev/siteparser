<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Observer;

use App\SiteParserCore\Resource\Marker\MarkerInterface;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Work\Observer\ObserverInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

interface SubscriberInterface extends MarkerInterface, ObserverInterface, EventSubscriberInterface
{
    public function subscribe(EventInterface $event): void;
}