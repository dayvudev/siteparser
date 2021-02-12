<?php declare(strict_types=1);
namespace App\Google\Business\Definition;

use App\Google\Business\Definition\DefinitionInterface;
use App\Google\Work\Handler\SearchResultsHandler;

interface SearchResultsInterface extends DefinitionInterface
{
    public const OWNER_NAME = 'Google';
    public const OWNER_URL = 'http://www.google.com';
    public const PARSER_NAME = 'Google - Search Results';
    public const ACTION_NAME = 'Google - Search By Keyword And Feth Result Links';
    public const ACTION_HANDLER_NAMESPACE = 'none';
    public const INPUT_NAME = 'Google - Search Results - Input';
    public const SOURCE_NAME = 'Google - Search Result Input Source';
    public const SOURCE_HANDLER_NAMESPACE = SearchResultsHandler::class;
    public const OUTPUT_NAME = 'Google - Search Results - Output';
    public const DESTINATION_NAME = 'Google - Search Result Output Destination';
    public const DESTINATION_HANDLER_NAMESPACE = SearchResultsHandler::class;

    public const SUBOUTPUT_NAME_TITLE = 'Google - Search Results - Output Result Title';
    public const SUBOUTPUT_NAME_URL = 'Google - Search Results - Output Result Url';

    public const GROUP_NAME = 'Google Search Results';
}
