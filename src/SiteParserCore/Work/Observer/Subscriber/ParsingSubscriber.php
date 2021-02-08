<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Observer\Subscriber;

use App\SiteParserCore\Business\Event\Parsing\BeforeEvent;
use App\SiteParserCore\Business\Event\Parsing\AfterEvent;
use App\SiteParserCore\Resource\Marker\Entity\HandlerResultInterface;
use App\SiteParserCore\Resource\Marker\Event\ParsingEventInterface;
use App\SiteParserCore\Resource\Marker\Observer\Subscriber\ParsingInterface;
use App\SiteParserCore\Work\Factory\Handler\HandlerFactory;
use App\SiteParserCore\Work\Provider\HandlerProvider;

class ParsingSubscriber implements ParsingInterface
{
    private $handlerProvider;

    public function __construct(HandlerProvider $handlerProvider)
    {
        $this->handlerProvider = $handlerProvider;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEvent::NAME => static::SUBSCRIBER_BEFORE_METHOD,
            AfterEvent::NAME => static::SUBSCRIBER_AFTER_METHOD
        ];
    }

    /**
     * @param BeforeEvent $event
     */
    public function subscribeBefore(ParsingEventInterface $event): HandlerResultInterface
    {
        return HandlerFactory::createResult();
    }

    /**
     * @param AfterEvent $event
     */
    public function subscribeAfter(ParsingEventInterface $event): HandlerResultInterface
    {
        $namespace = $event->getSource()->getHandlerNamespace();
        $handler = $this->handlerProvider->provide($namespace);

        $sourceResult = $handler->handleSource($event->getSource(), null);

        $argument = HandlerFactory::createArgument(['sourceResult' => $sourceResult]);
        
        return $handler->handleDestination($event->getDestination(), $argument);
    }
}
