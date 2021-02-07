<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Service\Execution;

use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\Service\ExecutionServiceInterface;
use App\SiteParserCore\Work\Observer\Dispatcher\AdaptationDispatcher;
use Exception;

class AdaptationService implements ExecutionServiceInterface
{
    private $dispatcher;

    private $beforeEvent = null;
    private $afterEvent = null;

    public function __construct(
        AdaptationDispatcher $dispatcher
    ) {
        $this->dispatcher = $dispatcher;
    }

    public function execute(): void
    {
        $this->dispatchBeforeEvent();
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
