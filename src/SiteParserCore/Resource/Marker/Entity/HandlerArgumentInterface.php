<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Entity;

use App\SiteParserCore\Resource\Marker\MarkerInterface;
use App\SiteParserCore\Resource\Entity\EntityInterface;

interface HandlerArgumentInterface extends MarkerInterface, EntityInterface
{
    public function setData(string $key, $value): self;
    public function getData(string $key);
    public function getHandlerResult(): ?HandlerResultInterface;
    public function setHandlerResult(HandlerResultInterface $handlerResult): self;
}
