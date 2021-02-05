<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Marker;

use App\DatabaseComponent\Work\Factory\FactoryInterface;

interface ORMEntityFactoryInterface extends MarkerInterface, FactoryInterface
{
    public static function create(): ORMEntityInterface;
}
