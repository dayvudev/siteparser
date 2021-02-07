<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Event;

use App\SiteParserCore\Business\Event\Execution\AfterEvent;
use App\SiteParserCore\Business\Event\Execution\BeforeEvent;
use App\SiteParserCore\Resource\Marker\Factory\Event\ExecutionInterface;

class ExecutionEventFactory implements ExecutionInterface
{
    public static function createBefore(): BeforeEvent
    {
        return new BeforeEvent();
    }

    public static function createAfter(): AfterEvent
    {
        return new AfterEvent();
    }
}
