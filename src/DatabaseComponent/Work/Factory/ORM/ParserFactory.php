<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\ORM;

use App\DatabaseComponent\Resource\Entity\ORM\Parser;
use App\DatabaseComponent\Resource\Marker\ORMEntityFactoryInterface;

class ParserFactory implements ORMEntityFactoryInterface
{
    public static function create(): Parser
    {
        return new Parser();
    }
}
