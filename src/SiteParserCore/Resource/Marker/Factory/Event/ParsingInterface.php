<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Factory\Event;

use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Business\Event\Parsing\AfterEvent;
use App\SiteParserCore\Business\Event\Parsing\BeforeEvent;
use App\SiteParserCore\Resource\Marker\Factory\EventInterface;

interface ParsingInterface extends EventInterface
{
    public static function createBefore(Source $source, Destination $destination): BeforeEvent;
    public static function createAfter(Source $source, Destination $destination): AfterEvent;
}
