<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker;

use App\SiteParserCore\Business\Event\EventInterface;

interface ExecutionEventInterface extends MarkerInterface, EventInterface
{
}
