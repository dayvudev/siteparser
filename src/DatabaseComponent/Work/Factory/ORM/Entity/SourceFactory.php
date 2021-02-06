<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\ORMEntityFactoryInterface;

class SourceFactory implements ORMEntityFactoryInterface
{
    public static function create(): Source
    {
        return new Source();
    }
}
