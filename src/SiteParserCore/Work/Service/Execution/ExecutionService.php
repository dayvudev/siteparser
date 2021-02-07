<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Service\Execution;

use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\Service\ExecutionServiceInterface;
use App\SiteParserCore\Work\Observer\Dispatcher\ExecutionDispatcher;
use App\SiteParserCore\Work\Service\Execution\AdaptationService;
use App\SiteParserCore\Work\Service\Execution\ConfigurationService;
use App\SiteParserCore\Work\Service\Execution\ParsingService;
use Exception;

class ExecutionService implements ExecutionServiceInterface
{
    private $dispatcher;

    private $beforeEvent = null;
    private $afterEvent = null;

    private $configurationService;
    private $parsingService;
    private $adaptationService;

    public function __construct(
        ExecutionDispatcher $executionDispatcher,
        ConfigurationService $configurationService,
        ParsingService $parsingService,
        AdaptationService $adaptationService
    ) {
        $this->dispatcher = $executionDispatcher;
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
        $this->beforeEvent = $this->dispatcher->dispatchBefore();
    }

    public function dispatchAfterEvent(): void
    {
        $this->afterEvent = $this->dispatcher->dispatchAfter();
    }

    /**
     * @throws Exception
     */
    public function getBeforeEvent(): ?EventInterface
    {
        return $this->beforeEvent;
    }

    /**
     * @throws Exception
     */
    public function getAfterEvent(): ?EventInterface
    {
        return $this->afterEvent;
    }
}
