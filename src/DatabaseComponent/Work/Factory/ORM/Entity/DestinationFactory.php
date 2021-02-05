<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\ORM\Entity;

use App\DatabaseComponent\Resource\Entity\ORM\Destination;
use App\DatabaseComponent\Resource\Marker\ORMEntityFactoryInterface;

class DestinationFactory implements ORMEntityFactoryInterface
{
    public static function create(): Destination
    {
        return new Destination();
    }
}
