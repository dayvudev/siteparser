<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker;

use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Work\Service\ServiceInterface;

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
