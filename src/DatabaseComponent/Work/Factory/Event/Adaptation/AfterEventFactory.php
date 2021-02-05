<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\Event\Adaptation;

use App\DatabaseComponent\Business\Event\Adaptation\AfterEvent;
use App\DatabaseComponent\Resource\Marker\AdaptationEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEventFactory extends Event implements AdaptationEventFactoryInterface
{
    public static function create(): AfterEvent
    {
        return new AfterEvent();
    }
}
