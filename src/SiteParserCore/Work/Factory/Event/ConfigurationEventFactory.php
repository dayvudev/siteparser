<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Event;

use App\SiteParserCore\Business\Event\Configuration\AfterEvent;
use App\SiteParserCore\Business\Event\Configuration\BeforeEvent;
use App\SiteParserCore\Resource\Marker\Factory\Event\ConfigurationInterface;

class ConfigurationEventFactory implements ConfigurationInterface
{
    public static function createBefore(): BeforeEvent
    {
        return new BeforeEvent();
    }

    public static function createAfter(): AfterEvent
    {
        return new AfterEvent();
    }
}
