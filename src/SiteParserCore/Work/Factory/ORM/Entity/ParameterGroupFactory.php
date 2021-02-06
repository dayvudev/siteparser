<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\ParameterGroup;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;

class ParameterGroupFactory implements ORMEntityFactoryInterface
{
    public static function create(): ParameterGroup
    {
        return new ParameterGroup();
    }
}
