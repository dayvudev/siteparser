<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\Event\Adaptation;

use App\DatabaseComponent\Business\Event\Adaptation\BeforeEvent;
use App\DatabaseComponent\Resource\Marker\AdaptationEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeEventFactory extends Event implements AdaptationEventFactoryInterface
{
    public static function create(): BeforeEvent
    {
        return new BeforeEvent();
    }
}
