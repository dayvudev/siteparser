<?php declare(strict_types=1);
namespace App\Google\Work\Factory\Configuration;

use App\Google\Resource\Entity\Configuration\SearchResultsConfiguration;
use App\SiteParserCore\Resource\Marker\Entity\ConfigurationEntityInterface;
use App\SiteParserCore\Work\Factory\FactoryInterface;

class EntityFactory implements FactoryInterface
{
    public static function createSearchResultsConfiguration(): ConfigurationEntityInterface
    {
        return new SearchResultsConfiguration();
    }
}
