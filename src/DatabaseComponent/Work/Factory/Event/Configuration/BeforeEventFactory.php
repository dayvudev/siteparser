<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\Event\Configuration;

use App\DatabaseComponent\Business\Event\Configuration\BeforeEvent;
use App\DatabaseComponent\Resource\Marker\ConfigurationEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeEventFactory extends Event implements ConfigurationEventFactoryInterface
{
    public static function create(): BeforeEvent
    {
        return new BeforeEvent();
    }
}
