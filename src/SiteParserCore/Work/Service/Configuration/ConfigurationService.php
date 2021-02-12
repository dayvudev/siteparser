<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Service\Configuration;

use App\SiteParserCore\Resource\Entity\ORM\Owner;
use App\SiteParserCore\Resource\Entity\ORM\Parser;
use App\SiteParserCore\Resource\Marker\Entity\ConfigurationEntityInterface;
use App\SiteParserCore\Work\Factory\ORM\Entity\ActionFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\DestinationFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\OwnerFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParserActionsFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParserFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\SourceFactory;
use App\SiteParserCore\Work\Provider\ORM\Repository\OwnerProvider;
use App\SiteParserCore\Work\Provider\ORM\Repository\ParserProvider;
use Doctrine\ORM\EntityManagerInterface;

class ConfigurationService
{
    private $parserRepositoryProvider;
    private $ownerRepositoryProvider;
    private $entityManager;

    public function __construct(
        ParserProvider $parserRepositoryProvider,
        OwnerProvider $ownerRepositoryProvider,
        EntityManagerInterface $entityManager
    ) {
        $this->parserRepositoryProvider = $parserRepositoryProvider; 
        $this->ownerRepositoryProvider = $ownerRepositoryProvider;  
        $this->entityManager = $entityManager;  
    }

    public function execute(ConfigurationEntityInterface $configuration): void
    {
        $parser = $this->parserRepositoryProvider
            ->provide()
            ->findOneBy([
                'name' => $configuration->getParserName(),
            ]);

        if (! $parser instanceof Parser) {
            $parser = ParserFactory::createInline(null, $configuration->getParserName());
        }
        
        $owner = $this->ownerRepositoryProvider
            ->provide()
            ->findOneBy([
                'name' => $configuration->getOwnerName(),
                'url' => $configuration->getOwnerUrl(),
            ]);

        if (! $owner instanceof Owner) {
            $owner = OwnerFactory::createInline($parser, null, $configuration->getOwnerName(), $configuration->getOwnerUrl());
        }
        
        $input = ParameterFactory::createInline(null, $configuration->getInputName());
        $source = SourceFactory::createInline($input, null, $configuration->getSourceName(), $configuration->getSourceHandlerNamespace());

        $output = ParameterFactory::createInline(null, $configuration->getOutputName());
        $destination = DestinationFactory::createInline($output, null, $configuration->getDestinationName(), $configuration->getDestinationHandlerNamespace());
        
        $action = ActionFactory::createInline($source, $destination, null, $configuration->getActionName(), $configuration->getActionHandlerNamespace());
        $parserAction = ParserActionsFactory::createInline($parser, $action);

        $this->entityManager->beginTransaction();

        $this->entityManager->persist($parser);
        $this->entityManager->persist($owner);
        $this->entityManager->persist($input);
        $this->entityManager->persist($source);
        $this->entityManager->persist($output);
        $this->entityManager->persist($destination);
        $this->entityManager->persist($action);
        $this->entityManager->persist($parserAction);

        try {
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Throwable $t) {
            $this->entityManager->rollback();
            throw $t;
        }
    }
}
