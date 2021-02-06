<?php declare(strict_types=1);
namespace App\GoogleSearchResultsScenario\Work\Observer\Subscriber\Configuration;

use App\GoogleSearchResultsScenario\Work\Service\Configuration\SearchResultsService;
use App\SiteParserCore\Business\Event\Configuration\AfterEvent;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\Observer\SubscriberInterface;
use Psr\Log\LoggerInterface;

class AfterEventSubscriber implements SubscriberInterface
{
    private $logger;
    private $service;

    public function __construct(
        LoggerInterface $logger,
        SearchResultsService $service
    ) {
        $this->logger = $logger;
        $this->service = $service;
    }

    public static function getSubscribedEvents()
    {
        return [
            AfterEvent::NAME => 'subscribe'
        ];
    }

    /**
     * @param AfterEvent $event
     */
    public function subscribe(EventInterface $event): void
    {
        $this->logger->info(static::class . ': STARTED : After Configuratino Event Subscriber');
        
        $this->service->execute();

        $this->logger->info(static::class . ': FINISHED : After Configuratino Event Subscriber');
    }
}
