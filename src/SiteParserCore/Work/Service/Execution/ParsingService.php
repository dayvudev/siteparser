<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Service\Execution;

use Exception;
use App\SiteParserCore\Resource\Entity\ORM\Owner;
use App\SiteParserCore\Resource\Entity\ORM\Action;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\ParserActions;
use App\SiteParserCore\Work\Provider\ORM\Repository\OwnerProvider;
use App\SiteParserCore\Resource\Marker\Service\ParsingServiceInterface;
use App\SiteParserCore\Work\Observer\Dispatcher\ParsingDispatcher;

class ParsingService implements ParsingServiceInterface
{
    /**
     * @var ParsingDispatcher
     */
    private $dispatcher;
    /**
     * @var OwnerProvider
     */
    private $ownerRepositoryProvider;

    private $beforeEvent = null;
    private $afterEvent = null;

    public function __construct(
        ParsingDispatcher $dispatcher,
        OwnerProvider $ownerRepositoryProvider
    ) {
        $this->dispatcher = $dispatcher;
        $this->ownerRepositoryProvider = $ownerRepositoryProvider;
    }

    public function execute(): void
    {
        $owners = $this->ownerRepositoryProvider->provide()->findAll();

        /** @var Owner $owner */
        foreach ($owners as $owner) {
            $parserActions = $owner->getParser()->getActions();
            
            /** @var ParserActions $parserAction */
            foreach ($parserActions as $parserAction) {
                $this->dispatchBeforeEvent($parserAction->getAction()->getSource(), $parserAction->getAction()->getDestination());
                $this->dispatchAfterEvent($parserAction->getAction()->getSource(), $parserAction->getAction()->getDestination());
            }
        }
    }
    
    public function dispatchBeforeEvent(Source $source, Destination $destination): void
    {
        $this->beforeEvent = $this->dispatcher->dispatchBefore($source, $destination);
    }

    public function dispatchAfterEvent(Source $source, Destination $destination): void
    {
        $this->afterEvent = $this->dispatcher->dispatchAfter($source, $destination);
    }

    /**
     * @throws Exception
     */
    public function getBeforeEvent(): ?EventInterface
    {
        return $this->beforeEvent;
    }

    /**
     * @throws Exception
     */
    public function getAfterEvent(): ?EventInterface
    {
        return $this->afterEvent;
    }
}
