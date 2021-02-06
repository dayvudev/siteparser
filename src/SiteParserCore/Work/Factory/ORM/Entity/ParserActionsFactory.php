<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\ParserActions;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;

class ParserActionsFactory implements ORMEntityFactoryInterface
{
    public static function create(): ParserActions
    {
        return new ParserActions();
    }
}
