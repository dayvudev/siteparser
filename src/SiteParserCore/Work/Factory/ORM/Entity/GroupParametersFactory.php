<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\GroupParameters;
use App\SiteParserCore\Resource\Marker\ORMEntityFactoryInterface;

class GroupParametersFactory implements ORMEntityFactoryInterface
{
    public static function create(): GroupParameters
    {
        return new GroupParameters();
    }
}
