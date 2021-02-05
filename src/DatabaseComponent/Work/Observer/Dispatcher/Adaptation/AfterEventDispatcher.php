<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Observer\Dispatcher\Adaptation;

use App\DatabaseComponent\Business\Event\Adaptation\AfterEvent;
use App\DatabaseComponent\Resource\Marker\DispatcherInterface;
use App\DatabaseComponent\Work\Factory\Event\Adaptation\AfterEventFactory;
use Symfony\Component\EventDispatcher\EventDispatcher;

class AfterEventDispatcher implements DispatcherInterface
{
    public function dispatch(): void
    {
        $dispatcher = new EventDispatcher();

        $dispatcher->dispatch(AfterEventFactory::create(), AfterEvent::NAME);
    }
}
