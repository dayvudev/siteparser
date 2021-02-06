<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Event\Execution;

use App\SiteParserCore\Business\Event\Execution\BeforeEvent;
use App\SiteParserCore\Resource\Marker\ExecutionEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeEventFactory extends Event implements ExecutionEventFactoryInterface
{
    public static function create(): BeforeEvent
    {
        return new BeforeEvent();
    }
}
