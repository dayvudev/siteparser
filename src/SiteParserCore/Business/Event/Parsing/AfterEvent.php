<?php declare(strict_types=1);
namespace App\SiteParserCore\Business\Event\Parsing;

use App\SiteParserCore\Resource\Marker\ParsingEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEvent extends Event implements ParsingEventInterface
{
    public const NAME = 'after.parsing';
}
