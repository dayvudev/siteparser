<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Marker;

use App\DatabaseComponent\Business\Event\EventInterface;
use App\DatabaseComponent\Work\Observer\ObserverInterface;

interface DispatcherInterface extends MarkerInterface, ObserverInterface
{
    public function dispatch(): ?EventInterface;
}
