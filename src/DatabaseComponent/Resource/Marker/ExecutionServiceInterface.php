<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Marker;

use App\DatabaseComponent\Business\Event\EventInterface;
use App\DatabaseComponent\Work\Service\ServiceInterface;

interface ExecutionServiceInterface extends MarkerInterface, ServiceInterface
{
    public const EXCEPTION_MESSAGE_EMPTY_EVENT = 'Event is empty!';
    
    public function dispatchBeforeEvent(): void;
    public function dispatchAfterEvent(): void;
    /**
     * @throws Exception
     */
    public function getBeforeEvent(): EventInterface;
    /**
     * @throws Exception
     */
    public function getAfterEvent(): EventInterface;
}
