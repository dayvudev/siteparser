<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker;

use App\SiteParserCore\Business\Event\EventInterface;

interface ParsingEventInterface extends MarkerInterface, EventInterface
{
}
