<?php declare(strict_types=1);
namespace App\GoogleSearchResultsScenario\Work\Observer\Subscriber\Adaptation;

use App\SiteParserCore\Business\Event\Adaptation\AfterEvent;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Entity\ORM\Action;
use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\Owner;
use App\SiteParserCore\Resource\Entity\ORM\Parameter;
use App\SiteParserCore\Resource\Entity\ORM\Parser;
use App\SiteParserCore\Resource\Entity\ORM\ParserActions;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\Observer\SubscriberInterface;
use App\SiteParserCore\Work\Factory\ORM\Entity\ActionFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\DestinationFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\OwnerFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParserActionsFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParserFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\SourceFactory;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;

class AfterEventSubscriber implements SubscriberInterface
{
    private $logger;
    private $entityManager;

    private $owner;
    private $parser;
    private $action;
    private $source;
    private $destination;
    private $input;
    private $output;
    private $parserAction;

    public function __construct(
        LoggerInterface $logger,
        EntityManagerInterface $entityManager
    ) {
        $this->logger = $logger;
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            AfterEvent::NAME => 'subscribe'
        ];
    }

    /**
     * @param AfterEvent $event
     */
    public function subscribe(EventInterface $event): void
    {
        $this->logger->info(static::class . ': STARTED : After Configuratino Event Subscriber');
        $this->entityManager->beginTransaction();

        $this->configureParser();
        $this->configureOwner();
        $this->configureAction();
        $this->configureSource();
        $this->configureDestination();
        $this->configureParserAction();
        $this->configureInput();
        $this->configureOutput();

        try {
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            $this->logger->info('Changes rolled back!');
            $this->entityManager->rollback();
        }

        $this->logger->info(static::class . ': FINISHED : After Configuratino Event Subscriber');
    }
    

    private function configureParser(): Parser
    {
        if ($this->parser instanceof Parser) {
            return $this->parser;
        }

        $this->parser = ParserFactory::create();
        
        $this->parser->setName('Google Search Results - Search');
        $this->parser->setCreationDate(new DateTime());
        $this->parser->setSortOrder(1);
        $this->parser->setIsDisable(false);

        $this->entityManager->persist($this->parser);
        return $this->parser;
    }

    private function configureOwner(): Owner
    {
        if ($this->owner instanceof Parser) {
            return $this->owner;
        }

        $this->owner = OwnerFactory::create();
        $this->owner->setParser($this->configureParser());
        
        $this->owner->setCreationDate(new DateTime());
        $this->owner->setName('Google Search');
        $this->owner->setUrl('http://google.com');

        $this->entityManager->persist($this->owner);
        return $this->owner;
    }

    private function configureAction(): Action
    {
        if ($this->action instanceof Parser) {
            return $this->action;
        }

        $this->action = ActionFactory::create();
        $this->action->setSource($this->configureSource());
        $this->action->setDestination($this->configureDestination());
        
        $this->action->setCreationDate(new DateTime());
        $this->action->setName('Fetch Search Result Links');
        $this->action->setHandlerNamespace('class');
        $this->action->setSortOrder(1);
        $this->action->setIsDisable(false);

        $this->entityManager->persist($this->action);
        return $this->action;
    }

    private function configureSource(): Source
    {
        if ($this->source instanceof Parser) {
            return $this->source;
        }

        $this->source = SourceFactory::create();
        $this->source->setInput($this->configureInput());

        $this->source->setCreationDate(new DateTime());
        $this->source->setName('Fetch Search Result Links Source');
        $this->source->setHandlerNamespace('class');

        $this->entityManager->persist($this->source);
        return $this->source;
    }

    private function configureDestination(): Destination
    {
        if ($this->destination instanceof Parser) {
            return $this->destination;
        }

        $this->destination = DestinationFactory::create();
        $this->destination->setOutput($this->configureOutput());

        $this->destination->setCreationDate(new DateTime());
        $this->destination->setName('Fetch Search Result Links Destination');
        $this->destination->setHandlerNamespace('class');

        $this->entityManager->persist($this->destination);
        return $this->destination;
    }

    private function configureParserAction(): ParserActions
    {
        if ($this->parserAction instanceof Parser) {
            return $this->parserAction;
        }

        $this->parserAction = ParserActionsFactory::create();

        $this->parserAction->setParser($this->configureParser());
        $this->parserAction->setAction($this->configureAction());
        $this->parserAction->setCreationDate(new DateTime());

        $this->entityManager->persist($this->parserAction);
        return $this->parserAction;
    }

    private function configureInput(): Parameter
    {
        if ($this->input instanceof Parser) {
            return $this->input;
        }

        $this->input = ParameterFactory::create();

        $this->input->setCreationDate(new DateTime());
        $this->input->setName('Fetch Search Result Links Source Input');

        $this->entityManager->persist($this->input);
        return $this->input;
    }

    private function configureOutput(): Parameter
    {
        if ($this->output instanceof Parser) {
            return $this->output;
        }

        $this->output = ParameterFactory::create();

        $this->output->setCreationDate(new DateTime());
        $this->output->setName('Fetch Search Result Links Destination Output');

        $this->entityManager->persist($this->output);
        return $this->output;
    }
}
