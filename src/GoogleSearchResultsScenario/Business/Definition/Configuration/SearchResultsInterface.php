<?php declare(strict_types=1);
namespace App\GoogleSearchResultsScenario\Business\Definition\Configuration;

use App\GoogleSearchResultsScenario\Business\Definition\DefinitionInterface;

interface SearchResultsInterface extends DefinitionInterface
{
    public const NAME_OWNER_NAME = 'Google';
    public const NAME_OWNER_URL = 'http://www.google.com';
    public const NAME_PARSER_NAME = 'Google - Search Results';
    public const NAME_ACTION_NAME = 'Google - Search By Keyword And Feth Result Links';
    public const NAME_SOURCE_NAME = 'Google - Search Result Input Source';
    public const NAME_INPUT_INPUT = 'Google - Search Results - Input';
    public const NAME_INPUT_KEYWORDS = 'Google - Search Results - Input Keyword';
    public const NAME_INPUT_SEARCH_URL = 'Google - Search Results - Input Search Url';
    public const NAME_DESTINATION_NAME = 'Google - Search Result Output Destination';
    public const NAME_OUTPUT_OUTPUT = 'Google - Search Results - Output';
    public const NAME_OUTPUT_SEARCH_RESULT_TITLE = 'Google - Search Results - Output Result Title';
    public const NAME_OUTPUT_SEARCH_RESULT_URL = 'Google - Search Results - Output Result Url';
}
