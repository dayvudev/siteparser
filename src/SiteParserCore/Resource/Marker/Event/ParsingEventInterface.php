<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Event;

use App\SiteParserCore\Resource\Marker\MarkerInterface;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\Source;

interface ParsingEventInterface extends MarkerInterface, EventInterface
{
    public function getSource(): Source;
    public function getDestination(): Destination;
}
