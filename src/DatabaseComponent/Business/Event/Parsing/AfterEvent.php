<?php declare(strict_types=1);
namespace App\DatabaseComponent\Business\Event\Parsing;

use App\DatabaseComponent\Resource\Marker\ParsingEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEvent extends Event implements ParsingEventInterface
{
    public const NAME = self::class;
}
