<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Marker;

use App\DatabaseComponent\Business\Event\EventInterface;

interface ParsingEventInterface extends MarkerInterface, EventInterface
{
}
