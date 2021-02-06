<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Value;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;

class ValueFactory implements ORMEntityFactoryInterface
{
    public static function create(): Value
    {
        return new Value();
    }
}
