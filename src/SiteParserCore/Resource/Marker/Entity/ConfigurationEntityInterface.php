<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Entity;

use App\SiteParserCore\Resource\Marker\MarkerInterface;
use App\SiteParserCore\Resource\Entity\EntityInterface;

interface ConfigurationEntityInterface extends MarkerInterface, EntityInterface
{
    public function getOwnerName(): string;
    public function getOwnerUrl(): string;
    public function getParserName(): string;
    public function getActionName(): string;
    public function getActionHandlerNamespace(): string;
    public function getInputName(): string;
    public function getSourceName(): string;
    public function getSourceHandlerNamespace(): string;
    public function getOutputName(): string;
    public function getDestinationName(): string;
    public function getDestinationHandlerNamespace(): string;
}
