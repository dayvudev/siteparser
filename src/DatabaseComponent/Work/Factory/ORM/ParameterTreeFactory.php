<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\ORM;

use App\DatabaseComponent\Resource\Entity\ORM\ParameterTree;
use App\DatabaseComponent\Resource\Marker\ORMEntityFactoryInterface;

class ParameterTreeFactory implements ORMEntityFactoryInterface
{
    public static function create(): ParameterTree
    {
        return new ParameterTree();
    }
}
