<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker;

use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Work\Observer\ObserverInterface;

interface DispatcherInterface extends MarkerInterface, ObserverInterface
{
    public function dispatch(): ?EventInterface;
}
