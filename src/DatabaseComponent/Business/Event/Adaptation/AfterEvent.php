<?php declare(strict_types=1);
namespace App\DatabaseComponent\Business\Event\Adaptation;

use App\DatabaseComponent\Resource\Marker\AdaptationEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEvent extends Event implements AdaptationEventInterface
{
    public const NAME = 'after.adaptation';
}
