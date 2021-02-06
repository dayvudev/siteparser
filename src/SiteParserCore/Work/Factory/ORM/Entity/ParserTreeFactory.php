<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\ParserTree;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;

class ParserTreeFactory implements ORMEntityFactoryInterface
{
    public static function create(): ParserTree
    {
        return new ParserTree();
    }
}
