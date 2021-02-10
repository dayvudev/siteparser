<?php declare(strict_types=1);
namespace App\Google\Work\Service\SearchResults;

use App\Google\Business\Definition\Configuration\SearchResultsInterface as Definition;
use App\Google\Work\Handler\DefaultHandler;
use App\Google\Work\Service\ServiceInterface;
use App\SiteParserCore\Work\Factory\ORM\Entity\ActionFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\DestinationFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\OwnerFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterTreeFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParserActionsFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParserFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\SourceFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ValueFactory;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class ConfigurationService implements ServiceInterface
{
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function execute(): void
    {
        $this->entityManager->beginTransaction();

        $parser = ParserFactory::createInline(null, Definition::NAME_PARSER_NAME);
        $this->entityManager->persist($parser);
            $owner = OwnerFactory::createInline($parser, null, Definition::NAME_OWNER_NAME, Definition::NAME_OWNER_URL);
            $this->entityManager->persist($owner);

        $input = ParameterFactory::createInline(null, Definition::NAME_INPUT_INPUT);
        $this->entityManager->persist($input);

        $output = ParameterFactory::createInline(null, Definition::NAME_OUTPUT_OUTPUT);
        $this->entityManager->persist($output);

        $source = SourceFactory::createInline($input, null, Definition::NAME_SOURCE_NAME, Definition::NAME_SOURCE_HANDLER);
        $this->entityManager->persist($source);

        $destination = DestinationFactory::createInline($output, null, Definition::NAME_DESTINATION_NAME, Definition::NAME_DESTINATION_HANDLER);
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
