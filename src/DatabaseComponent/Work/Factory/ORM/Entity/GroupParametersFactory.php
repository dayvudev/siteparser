<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\ORM\Entity;

use App\DatabaseComponent\Resource\Entity\ORM\GroupParameters;
use App\DatabaseComponent\Resource\Marker\ORMEntityFactoryInterface;

class GroupParametersFactory implements ORMEntityFactoryInterface
{
    public static function create(): GroupParameters
    {
        return new GroupParameters();
    }
}
