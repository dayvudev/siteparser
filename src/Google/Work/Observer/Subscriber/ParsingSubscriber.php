<?php declare(strict_types=1);
namespace App\Google\Work\Observer\Subscriber;

use App\Google\Work\Service\SearchResults\ParsingService;
use App\SiteParserCore\Business\Event\Parsing\BeforeEvent;
use App\SiteParserCore\Business\Event\Parsing\AfterEvent;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\Observer\Subscriber\ParsingInterface;

class ParsingSubscriber implements ParsingInterface
{
    private $service;

    public function __construct(ParsingService $service)
    {
        $this->service = $service;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEvent::NAME => static::SUBSCRIBER_BEFORE_METHOD,
            AfterEvent::NAME => static::SUBSCRIBER_AFTER_METHOD
        ];
    }

    /**
     * @param BeforeEvent $event
     */
    public function subscribeBefore(EventInterface $event): void
    {
    }

    /**
     * @param AfterEvent $event
     */
    public function subscribeAfter(EventInterface $event): void
    {
    }
}
