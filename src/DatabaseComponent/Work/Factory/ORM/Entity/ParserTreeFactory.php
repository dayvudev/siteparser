<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\ORM\Entity;

use App\DatabaseComponent\Resource\Entity\ORM\ParserTree;
use App\DatabaseComponent\Resource\Marker\ORMEntityFactoryInterface;

class ParserTreeFactory implements ORMEntityFactoryInterface
{
    public static function create(): ParserTree
    {
        return new ParserTree();
    }
}
