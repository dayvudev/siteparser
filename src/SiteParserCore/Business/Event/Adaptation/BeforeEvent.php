<?php declare(strict_types=1);
namespace App\SiteParserCore\Business\Event\Adaptation;

use App\SiteParserCore\Resource\Marker\Event\AdaptationEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeEvent extends Event implements AdaptationEventInterface
{
    public const NAME = 'before.adaptation';
}