<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Observer\Dispatcher\Adaptation;

use App\DatabaseComponent\Business\Event\Adaptation\BeforeEvent;
use App\DatabaseComponent\Resource\Marker\DispatcherInterface;
use App\DatabaseComponent\Work\Factory\Event\Adaptation\BeforeEventFactory;
use Symfony\Component\EventDispatcher\EventDispatcher;

class BeforeEventDispatcher implements DispatcherInterface
{
    public function dispatch(): void
    {
        $dispatcher = new EventDispatcher();

        $dispatcher->dispatch(BeforeEventFactory::create(), BeforeEvent::NAME);
    }
}
