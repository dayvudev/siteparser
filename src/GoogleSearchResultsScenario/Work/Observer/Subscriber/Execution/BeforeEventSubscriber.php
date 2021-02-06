<?php declare(strict_types=1);
namespace App\GoogleSearchResultsScenario\Work\Observer\Subscriber\Execution;

use App\SiteParserCore\Business\Event\Execution\BeforeEvent;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\Observer\SubscriberInterface;
use Psr\Log\LoggerInterface;

class BeforeEventSubscriber implements SubscriberInterface
{
    private $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEvent::NAME => 'subscribe'
        ];
    }

    /**
     * @param BeforeEvent $event
     */
    public function subscribe(EventInterface $event): void
    {
        $this->logger->info('EXECUTED: ' . static::class);
    }
}
