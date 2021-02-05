<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\ORM;

use App\DatabaseComponent\Resource\Entity\ORM\Value;
use App\DatabaseComponent\Resource\Marker\ORMEntityFactoryInterface;

class ValueFactory implements ORMEntityFactoryInterface
{
    public static function create(): Value
    {
        return new Value();
    }
}
