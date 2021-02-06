<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Action;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;

class ActionFactory implements ORMEntityFactoryInterface
{
    public static function create(): Action
    {
        return new Action();
    }
}
