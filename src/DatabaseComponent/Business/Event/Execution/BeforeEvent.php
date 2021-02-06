<?php declare(strict_types=1);
namespace App\SiteParserCore\Business\Event\Execution;

use App\SiteParserCore\Resource\Marker\ExecutionEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeEvent extends Event implements ExecutionEventInterface
{
    public const NAME = 'after.execution';
}
