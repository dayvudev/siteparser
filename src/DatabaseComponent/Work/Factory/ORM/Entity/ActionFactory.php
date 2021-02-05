<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\ORM\Entity;

use App\DatabaseComponent\Resource\Entity\ORM\Action;
use App\DatabaseComponent\Resource\Marker\ORMEntityFactoryInterface;

class ActionFactory implements ORMEntityFactoryInterface
{
    public static function create(): Action
    {
        return new Action();
    }
}
