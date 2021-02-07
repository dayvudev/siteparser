<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Observer\Subscriber;

use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\Observer\SubscriberInterface;

interface ExecutionInterface extends SubscriberInterface
{
    public function subscribeBefore(EventInterface $event): void;
    public function subscribeAfter(EventInterface $event): void;
}
