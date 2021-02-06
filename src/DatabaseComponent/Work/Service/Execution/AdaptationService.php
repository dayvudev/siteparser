<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Service\Execution;

use App\DatabaseComponent\Business\Event\EventInterface;
use App\DatabaseComponent\Resource\Marker\ExecutionServiceInterface;
use App\DatabaseComponent\Work\Observer\Dispatcher\Adaptation\AfterEventDispatcher;
use App\DatabaseComponent\Work\Observer\Dispatcher\Adaptation\BeforeEventDispatcher;
use Exception;

class AdaptationService implements ExecutionServiceInterface
{
    private $beforeEventDispatcher;
    private $afterEventDispatcher;

    private $beforeEvent;
    private $afterEvent;

    public function __construct(
        BeforeEventDispatcher $beforeEventDispatcher,
        AfterEventDispatcher $afterEventDispatcher
    ) {
        $this->beforeEventDispatcher = $beforeEventDispatcher;
        $this->afterEventDispatcher = $afterEventDispatcher;
    }

    public function execute(): void
    {
        $this->dispatchBeforeEvent();
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
