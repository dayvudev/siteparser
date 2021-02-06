<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Event\Adaptation;

use App\SiteParserCore\Business\Event\Adaptation\AfterEvent;
use App\SiteParserCore\Resource\Marker\Factory\AdaptationEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEventFactory extends Event implements AdaptationEventFactoryInterface
{
    public static function create(): AfterEvent
    {
        return new AfterEvent();
    }
}
