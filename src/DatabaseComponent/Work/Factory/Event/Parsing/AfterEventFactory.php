<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Event\Parsing;

use App\SiteParserCore\Business\Event\Parsing\AfterEvent;
use App\SiteParserCore\Resource\Marker\ParsingEventFactoryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEventFactory extends Event implements ParsingEventFactoryInterface
{
    public static function create(): AfterEvent
    {
        return new AfterEvent();
    }
}
