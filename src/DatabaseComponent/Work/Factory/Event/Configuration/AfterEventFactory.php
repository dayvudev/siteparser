<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\Event\Configuration;

use App\DatabaseComponent\Business\Event\Configuration\AfterEvent;
use App\DatabaseComponent\Resource\Marker\ConfigurationEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEventFactory extends Event implements ConfigurationEventFactoryInterface
{
    public static function create(): AfterEvent
    {
        return new AfterEvent();
    }
}
