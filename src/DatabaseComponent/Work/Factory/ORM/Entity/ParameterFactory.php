<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Parameter;
use App\SiteParserCore\Resource\Marker\ORMEntityFactoryInterface;

class ParameterFactory implements ORMEntityFactoryInterface
{
    public static function create(): Parameter
    {
        return new Parameter();
    }
}
