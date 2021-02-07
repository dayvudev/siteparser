<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Observer\Dispatcher;

use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\Observer\DispatcherInterface;

interface ParsingInterface extends DispatcherInterface
{
    public function dispatchBefore(Source $source, Destination $destination): ?EventInterface;
    public function dispatchAfter(Source $source, Destination $destination): ?EventInterface;
}
