<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Service\Execution\Step;

use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\Service\ExecutionServiceInterface;
use App\SiteParserCore\Work\Observer\Dispatcher\Parsing\AfterEventDispatcher;
use App\SiteParserCore\Work\Observer\Dispatcher\Parsing\BeforeEventDispatcher;
use Exception;

class ParsingService implements ExecutionServiceInterface
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
