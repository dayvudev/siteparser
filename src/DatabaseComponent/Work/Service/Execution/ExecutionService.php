<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Service\Execution;

use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\ExecutionServiceInterface;
use App\SiteParserCore\Work\Observer\Dispatcher\Execution\AfterEventDispatcher;
use App\SiteParserCore\Work\Observer\Dispatcher\Execution\BeforeEventDispatcher;
use App\SiteParserCore\Work\Service\Execution\Step\AdaptationService;
use App\SiteParserCore\Work\Service\Execution\Step\ConfigurationService;
use App\SiteParserCore\Work\Service\Execution\Step\ParsingService;
use Exception;

class ExecutionService implements ExecutionServiceInterface
{
    private $beforeEventDispatcher;
    private $afterEventDispatcher;

    private $beforeEvent;
    private $afterEvent;

    private $configurationService;
    private $parsingService;
    private $adaptationService;

    public function __construct(
        BeforeEventDispatcher $beforeEventDispatcher,
        AfterEventDispatcher $afterEventDispatcher,
        ConfigurationService $configurationService,
        ParsingService $parsingService,
        AdaptationService $adaptationService
    ) {
        $this->beforeEventDispatcher = $beforeEventDispatcher;
        $this->afterEventDispatcher = $afterEventDispatcher;
        $this->configurationService = $configurationService;
        $this->parsingService = $parsingService;
        $this->adaptationService = $adaptationService;
    }

    public function execute(): void
    {
        $this->dispatchBeforeEvent();

        $this->configurationService->execute();
        $this->parsingService->execute();
        $this->adaptationService->execute();

        $this->dispatchAfterEvent();
    }
    
    public function dispatchBeforeEvent(): void
    {
        $this->beforeEvent = $this->beforeEventDispatcher->dispatch();
    }

    public function dispatchAfterEvent(): void
    {
        $this->afterEvent = $this->afterEventDispatcher->dispatch();
    }

    /**
     * @throws Exception
     */
    public function getBeforeEvent(): EventInterface
    {
        if (! $this->beforeEvent instanceof EventInterface) {
            throw new Exception(static::EXCEPTION_MESSAGE_EMPTY_EVENT);
        }

        return $this->beforeEvent;
    }

    /**
     * @throws Exception
     */
    public function getAfterEvent(): EventInterface
    {
        if (! $this->afterEvent instanceof EventInterface) {
            throw new Exception(static::EXCEPTION_MESSAGE_EMPTY_EVENT);
        }

        return $this->afterEvent;
    }
}
