<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\ParameterTree;
use App\SiteParserCore\Resource\Marker\ORMEntityFactoryInterface;

class ParameterTreeFactory implements ORMEntityFactoryInterface
{
    public static function create(): ParameterTree
    {
        return new ParameterTree();
    }
}
