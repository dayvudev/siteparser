<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\Event\Execution;

use App\DatabaseComponent\Business\Event\Execution\BeforeEvent;
use App\DatabaseComponent\Resource\Marker\ExecutionEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeEventFactory extends Event implements ExecutionEventFactoryInterface
{
    public static function create(): BeforeEvent
    {
        return new BeforeEvent();
    }
}
