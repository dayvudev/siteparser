<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Factory;

use App\SiteParserCore\Resource\Marker\Entity\ORMEntityInterface;
use App\SiteParserCore\Resource\Marker\MarkerInterface;
use App\SiteParserCore\Work\Factory\FactoryInterface;

interface ORMEntityFactoryInterface extends MarkerInterface, FactoryInterface
{
    public static function create(): ORMEntityInterface;
}
