<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Marker\ORMEntityFactoryInterface;

class DestinationFactory implements ORMEntityFactoryInterface
{
    public static function create(): Destination
    {
        return new Destination();
    }
}
