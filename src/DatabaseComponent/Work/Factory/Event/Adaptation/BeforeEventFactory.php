<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Event\Adaptation;

use App\SiteParserCore\Business\Event\Adaptation\BeforeEvent;
use App\SiteParserCore\Resource\Marker\AdaptationEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeEventFactory extends Event implements AdaptationEventFactoryInterface
{
    public static function create(): BeforeEvent
    {
        return new BeforeEvent();
    }
}
