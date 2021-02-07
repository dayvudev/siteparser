<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Event\Parsing;

use App\SiteParserCore\Business\Event\Parsing\BeforeEvent;
use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\Factory\ParsingEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeEventFactory extends Event implements ParsingEventFactoryInterface
{
    public static function create(Source $source, Destination $destination): BeforeEvent
    {
        return new BeforeEvent($source, $destination);
    }
}
