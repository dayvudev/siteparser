<?php declare(strict_types=1);
namespace App\Google\Resource\Entity\Configuration;

use App\Google\Business\Definition\SearchResultsInterface;
use App\SiteParserCore\Resource\Marker\Entity\ConfigurationEntityInterface;

class SearchResultsConfiguration implements ConfigurationEntityInterface
{
    public function getOwnerName(): string
    {
        return SearchResultsInterface::OWNER_NAME;
    }

    public function getOwnerUrl(): string
    {
        return SearchResultsInterface::OWNER_URL;
    }

    public function getParserName(): string
    {
        return SearchResultsInterface::PARSER_NAME;
    }

    public function getActionName(): string
    {
        return SearchResultsInterface::ACTION_NAME;
    }

    public function getActionHandlerNamespace(): string
    {
        return SearchResultsInterface::ACTION_HANDLER_NAMESPACE;
    }

    public function getInputName(): string
    {
        return SearchResultsInterface::INPUT_NAME;
    }

    public function getSourceName(): string
    {
        return SearchResultsInterface::SOURCE_NAME;
    }

    public function getSourceHandlerNamespace(): string
    {
        return SearchResultsInterface::SOURCE_HANDLER_NAMESPACE;
    }

    public function getOutputName(): string
    {
        return SearchResultsInterface::OUTPUT_NAME;
    }


    public function getDestinationName(): string
    {
        return SearchResultsInterface::DESTINATION_NAME;
    }

    public function getDestinationHandlerNamespace(): string
    {
        return SearchResultsInterface::DESTINATION_HANDLER_NAMESPACE;
    }
}
