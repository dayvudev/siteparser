<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Factory\Event;

use App\SiteParserCore\Business\Event\Execution\AfterEvent;
use App\SiteParserCore\Business\Event\Execution\BeforeEvent;
use App\SiteParserCore\Resource\Marker\Factory\EventInterface;

interface ExecutionInterface extends EventInterface
{
    public static function createBefore(): BeforeEvent;
    public static function createAfter(): AfterEvent;
}
