<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Factory;

use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\Event\ParsingEventInterface;
use App\SiteParserCore\Resource\Marker\MarkerInterface;
use App\SiteParserCore\Work\Factory\FactoryInterface;

interface ParsingEventFactoryInterface extends MarkerInterface, FactoryInterface
{
    public static function create(Source $souce, Destination $destination): ParsingEventInterface;
}
