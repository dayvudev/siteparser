<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\ORM\Entity;

use App\DatabaseComponent\Resource\Entity\ORM\Parameter;
use App\DatabaseComponent\Resource\Marker\ORMEntityFactoryInterface;

class ParameterFactory implements ORMEntityFactoryInterface
{
    public static function create(): Parameter
    {
        return new Parameter();
    }
}
