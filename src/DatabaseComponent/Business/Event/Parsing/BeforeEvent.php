<?php declare(strict_types=1);
namespace App\DatabaseComponent\Business\Event\Parsing;

use App\DatabaseComponent\Resource\Marker\ParsingEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeEvent extends Event implements ParsingEventInterface
{
    public const NAME = self::class;
}
