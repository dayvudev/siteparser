<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Observer;

use Psr\EventDispatcher\EventDispatcherInterface;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\MarkerInterface;
use App\SiteParserCore\Work\Observer\ObserverInterface;
use Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher;

interface DispatcherInterface extends MarkerInterface, ObserverInterface
{
    public function dispatch(): ?EventInterface;
    /**
     * @return TraceableEventDispatcher|EventDispatcherInterface
     */
    public function getEventDispatcher(): EventDispatcherInterface;
}
