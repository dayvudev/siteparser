<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Observer\Subscriber;

use App\SiteParserCore\Resource\Marker\Entity\HandlerResultInterface;
use App\SiteParserCore\Resource\Marker\Event\ParsingEventInterface;
use App\SiteParserCore\Resource\Marker\Observer\SubscriberInterface;

interface ParsingInterface extends SubscriberInterface
{
    public function subscribeBefore(ParsingEventInterface $event): HandlerResultInterface;
    public function subscribeAfter(ParsingEventInterface $event): HandlerResultInterface;
}
