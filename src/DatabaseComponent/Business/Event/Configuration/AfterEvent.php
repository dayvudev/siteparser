<?php declare(strict_types=1);
namespace App\DatabaseComponent\Business\Event\Configuration;

use App\DatabaseComponent\Resource\Marker\ConfigurationEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AfterEvent extends Event implements ConfigurationEventInterface
{
    public const NAME = 'after.configuration';
}
