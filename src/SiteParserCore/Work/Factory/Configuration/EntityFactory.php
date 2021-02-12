<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Configuration;

use App\SiteParserCore\Resource\Entity\Configuration\DefaultConfiguration;
use App\SiteParserCore\Resource\Marker\Entity\ConfigurationEntityInterface;
use App\SiteParserCore\Work\Factory\FactoryInterface;

class EntityFactory implements FactoryInterface
{
    public static function createDefault(?string $default = null): ConfigurationEntityInterface
    {
        return new DefaultConfiguration($default);
    }
}
