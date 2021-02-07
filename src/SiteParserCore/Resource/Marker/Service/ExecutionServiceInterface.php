<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Service;

use App\SiteParserCore\Resource\Marker\MarkerInterface;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Work\Service\ServiceInterface;

interface ExecutionServiceInterface extends MarkerInterface, ServiceInterface
{
    public function getBeforeEvent(): ?EventInterface;
    public function getAfterEvent(): ?EventInterface;
}
