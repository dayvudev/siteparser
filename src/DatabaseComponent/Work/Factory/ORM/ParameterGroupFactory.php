<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\ORM;

use App\DatabaseComponent\Resource\Entity\ORM\ParameterGroup;
use App\DatabaseComponent\Resource\Marker\ORMEntityFactoryInterface;

class ParameterGroupFactory implements ORMEntityFactoryInterface
{
    public static function create(): ParameterGroup
    {
        return new ParameterGroup();
    }
}
