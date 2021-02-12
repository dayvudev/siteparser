<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Entity\Configuration;

use App\SiteParserCore\Resource\Marker\Entity\ConfigurationEntityInterface;
use Symfony\Component\Uid\Uuid;

class DefaultConfiguration implements ConfigurationEntityInterface
{
    private $default;

    public function __construct(?string $default = null)
    {
        $this->default = $default;
    }
    
    public function getOwnerName(): string
    {
        return $this->default ?? (string) Uuid::v6();
    }

    public function getOwnerUrl(): string
    {
        return $this->default ?? (string) Uuid::v6();
    }

    public function getParserName(): string
    {
        return $this->default ?? (string) Uuid::v6();
    }

    public function getActionName(): string
    {
        return $this->default ?? (string) Uuid::v6();
    }

    public function getActionHandlerNamespace(): string
    {
        return $this->default ?? (string) Uuid::v6();
    }

    public function getInputName(): string
    {
        return $this->default ?? (string) Uuid::v6();
    }

    public function getSourceName(): string
    {
        return $this->default ?? (string) Uuid::v6();
    }

    public function getSourceHandlerNamespace(): string
    {
        return $this->default ?? (string) Uuid::v6();
    }

    public function getOutputName(): string
    {
        return $this->default ?? (string) Uuid::v6();
    }


    public function getDestinationName(): string
    {
        return $this->default ?? (string) Uuid::v6();
    }

    public function getDestinationHandlerNamespace(): string
    {
        return $this->default ?? (string) Uuid::v6();
    }
}
