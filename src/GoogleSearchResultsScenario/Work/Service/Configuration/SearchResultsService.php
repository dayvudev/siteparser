<?php declare(strict_types=1);
namespace App\GoogleSearchResultsScenario\Work\Service\Configuration;

use App\GoogleSearchResultsScenario\Business\Definition\Configuration\SearchResultsInterface as Definition;
use App\GoogleSearchResultsScenario\Work\Service\ServiceInterface;
use App\SiteParserCore\Work\Factory\ORM\Entity\ActionFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\DestinationFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\OwnerFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParserActionsFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParserFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\SourceFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ValueFactory;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class SearchResultsService implements ServiceInterface
{
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function execute()
    {
        $this->entityManager->beginTransaction();

        $parser = ParserFactory::createInline(null, Definition::NAME_PARSER_NAME);
        $this->entityManager->persist($parser);
            $owner = OwnerFactory::createInline($parser, null, Definition::NAME_OWNER_NAME, Definition::NAME_OWNER_URL);
            $this->entityManager->persist($owner);

        $input = ParameterFactory::createInline(null, Definition::NAME_INPUT_INPUT);
        $this->entityManager->persist($input);
            $inputKeywords = ParameterFactory::createInline(null, Definition::NAME_INPUT_KEYWORDS);
            $this->entityManager->persist($inputKeywords);
                $valueTestKeyword = ValueFactory::createInline($inputKeywords, null, 'test');
                $this->entityManager->persist($valueTestKeyword);
                $valueTestKeyword = ValueFactory::createInline($inputKeywords, null, 'client');
                $this->entityManager->persist($valueTestKeyword);
            $inputUrls = ParameterFactory::createInline(null, Definition::NAME_INPUT_SEARCH_URL);
            $this->entityManager->persist($inputUrls);
                $valueSearchUrl = ValueFactory::createInline($inputUrls, null, 'http://www.google.com');
                $this->entityManager->persist($valueSearchUrl);

        $output = ParameterFactory::createInline(null, Definition::NAME_OUTPUT_OUTPUT);
        $this->entityManager->persist($output);
            $inputKeywords = ParameterFactory::createInline(null, Definition::NAME_OUTPUT_SEARCH_RESULT_TITLE);
            $this->entityManager->persist($inputKeywords);
            $inputUrls = ParameterFactory::createInline(null, Definition::NAME_OUTPUT_SEARCH_RESULT_URL);
            $this->entityManager->persist($inputUrls);

        $source = SourceFactory::createInline($input, null, Definition::NAME_SOURCE_NAME, 'class');
        $this->entityManager->persist($source);

        $destination = DestinationFactory::createInline($output, null, Definition::NAME_DESTINATION_NAME, 'class');
        $this->entityManager->persist($destination);

        $action = ActionFactory::createInline($source, $destination, null, Definition::NAME_ACTION_NAME, 'class');
        $this->entityManager->persist($action);
        
        $parserAction = ParserActionsFactory::createInline($parser, $action);
        $this->entityManager->persist($parserAction);

        try {
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }
    }
}
