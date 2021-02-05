<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\ORM\Entity;

use App\DatabaseComponent\Resource\Entity\ORM\Owner;
use App\DatabaseComponent\Resource\Marker\ORMEntityFactoryInterface;

class OwnerFactory implements ORMEntityFactoryInterface
{
    public static function create(): Owner
    {
        return new Owner();
    }
}
