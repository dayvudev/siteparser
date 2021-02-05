<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Marker;

use App\DatabaseComponent\Business\Event\EventInterface;

interface ExecutionEventInterface extends MarkerInterface, EventInterface
{
}
