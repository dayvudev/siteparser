<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Observer\Subscriber;

use App\SiteParserCore\Business\Event\Execution\BeforeEvent;
use App\SiteParserCore\Business\Event\Execution\AfterEvent;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\Observer\Subscriber\ExecutionInterface;
use App\SiteParserCore\Work\Service\Database\MigrationRefreshService;

class ExecutionSubscriber implements ExecutionInterface
{
    private $migrationRefreshService;

    public function __construct(MigrationRefreshService $migrationRefreshService)
    {
        $this->migrationRefreshService = $migrationRefreshService;
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
        $this->migrationRefreshService->execute();
    }

    /**
     * @param AfterEvent $event
     */
    public function subscribeAfter(EventInterface $event): void
    {
    }
}
