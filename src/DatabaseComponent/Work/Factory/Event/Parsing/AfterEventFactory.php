<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\Event\Parsing;

use App\DatabaseComponent\Business\Event\Parsing\AfterEvent;
use App\DatabaseComponent\Resource\Marker\ParsingEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEventFactory extends Event implements ParsingEventFactoryInterface
{
    public static function create(): AfterEvent
    {
        return new AfterEvent();
    }
}
