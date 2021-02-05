<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Observer\Dispatcher\Configuration;

use App\DatabaseComponent\Business\Event\Configuration\AfterEvent;
use App\DatabaseComponent\Resource\Marker\DispatcherInterface;
use App\DatabaseComponent\Work\Factory\Event\Configuration\AfterEventFactory;
use Symfony\Component\EventDispatcher\EventDispatcher;

class AfterEventDispatcher implements DispatcherInterface
{
    public function dispatch(): void
    {
        $dispatcher = new EventDispatcher();

        $dispatcher->dispatch(AfterEventFactory::create(), AfterEvent::NAME);
    }
}
