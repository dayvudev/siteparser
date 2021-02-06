<?php declare(strict_types=1);
namespace App\SiteParserCore\Business\Event\Execution;

use App\SiteParserCore\Resource\Marker\Event\ExecutionEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEvent extends Event implements ExecutionEventInterface
{
    public const NAME = 'after.execution';
}
