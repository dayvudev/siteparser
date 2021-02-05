<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\ORM;

use App\DatabaseComponent\Resource\Entity\ORM\ParserActions;
use App\DatabaseComponent\Resource\Marker\ORMEntityFactoryInterface;

class ParserActionsFactory implements ORMEntityFactoryInterface
{
    public static function create(): ParserActions
    {
        return new ParserActions();
    }
}
