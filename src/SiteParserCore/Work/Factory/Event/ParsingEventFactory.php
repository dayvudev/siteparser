<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Event;

use App\SiteParserCore\Business\Event\Parsing\AfterEvent;
use App\SiteParserCore\Business\Event\Parsing\BeforeEvent;
use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\Factory\Event\ParsingInterface;

class ParsingEventFactory implements ParsingInterface
{
    public static function createBefore(Source $source, Destination $destination): BeforeEvent
    {
        return new BeforeEvent($source, $destination);
    }

    public static function createAfter(Source $source, Destination $destination): AfterEvent
    {
        return new AfterEvent($source, $destination);
    }
}
