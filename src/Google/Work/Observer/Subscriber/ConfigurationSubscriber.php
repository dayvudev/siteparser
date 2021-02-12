<?php declare(strict_types=1);
namespace App\Google\Work\Observer\Subscriber;

use App\Google\Work\Factory\Configuration\EntityFactory;
use App\SiteParserCore\Business\Event\Configuration\BeforeEvent;
use App\SiteParserCore\Business\Event\Configuration\AfterEvent;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\Observer\Subscriber\ConfigurationInterface;
use App\SiteParserCore\Work\Service\Configuration\ConfigurationService;

class ConfigurationSubscriber implements ConfigurationInterface
{
    private $configurationService;

    public function __construct(ConfigurationService $configurationService)
    {
        $this->configurationService = $configurationService;
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
        $this->configurationService->execute(EntityFactory::createSearchResultsConfiguration());
    }

    /**
     * @param AfterEvent $event
     */
    public function subscribeAfter(EventInterface $event): void
    {
    }
}
