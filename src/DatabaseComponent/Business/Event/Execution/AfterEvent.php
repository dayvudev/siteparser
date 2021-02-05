<?php declare(strict_types=1);
namespace App\DatabaseComponent\Business\Event\Execution;

use App\DatabaseComponent\Resource\Marker\ExecutionEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEvent extends Event implements ExecutionEventInterface
{
    public const NAME = 'after.execution';
}
