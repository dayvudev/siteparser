<?php declare(strict_types=1);
namespace App\SiteParserCore\Business\Event\Configuration;

use App\SiteParserCore\Resource\Marker\Event\ConfigurationEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeEvent extends Event implements ConfigurationEventInterface
{
    public const NAME = 'before.configuration';
}
