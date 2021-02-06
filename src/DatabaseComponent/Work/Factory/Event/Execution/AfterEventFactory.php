<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Event\Execution;

use App\SiteParserCore\Business\Event\Execution\AfterEvent;
use App\SiteParserCore\Resource\Marker\ExecutionEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEventFactory extends Event implements ExecutionEventFactoryInterface
{
    public static function create(): AfterEvent
    {
        return new AfterEvent();
    }
}
