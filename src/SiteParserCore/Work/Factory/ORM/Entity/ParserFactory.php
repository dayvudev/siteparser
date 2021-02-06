<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Parser;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;

class ParserFactory implements ORMEntityFactoryInterface
{
    public static function create(): Parser
    {
        return new Parser();
    }
}
