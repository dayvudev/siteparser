<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Observer\Dispatcher;

use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Marker\Observer\DispatcherInterface;

interface ExecutionInterface extends DispatcherInterface
{
    public function dispatchBefore(): ?EventInterface;
    public function dispatchAfter(): ?EventInterface;
}
