<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\Event\Execution;

use App\DatabaseComponent\Business\Event\Execution\AfterEvent;
use App\DatabaseComponent\Resource\Marker\ExecutionEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEventFactory extends Event implements ExecutionEventFactoryInterface
{
    public static function create(): AfterEvent
    {
        return new AfterEvent();
    }
}
