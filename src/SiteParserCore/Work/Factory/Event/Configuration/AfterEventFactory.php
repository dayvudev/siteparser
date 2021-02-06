<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Event\Configuration;

use App\SiteParserCore\Business\Event\Configuration\AfterEvent;
use App\SiteParserCore\Resource\Marker\Factory\ConfigurationEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEventFactory extends Event implements ConfigurationEventFactoryInterface
{
    public static function create(): AfterEvent
    {
        return new AfterEvent();
    }
}
