<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\Event\Parsing;

use App\DatabaseComponent\Business\Event\Parsing\BeforeEvent;
use App\DatabaseComponent\Resource\Marker\ParsingEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeEventFactory extends Event implements ParsingEventFactoryInterface
{
    public static function create(): BeforeEvent
    {
        return new BeforeEvent();
    }
}
