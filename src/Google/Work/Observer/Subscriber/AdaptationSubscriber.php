<?php declare(strict_types=1);
namespace App\Google\Work\Observer\Subscriber;

use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Entity\ORM\ParameterGroup;
use App\SiteParserCore\Business\Event\Adaptation\AfterEvent;
use App\SiteParserCore\Business\Event\Adaptation\BeforeEvent;
use App\SiteParserCore\Work\Provider\ORM\Repository\ParameterGroupProvider;
use App\SiteParserCore\Resource\Marker\Observer\Subscriber\AdaptationInterface;
use App\Google\Business\Definition\SearchResultsInterface as Definition;
use App\SiteParserCore\Work\Adapter\Export\ExternalExportAdapter;
use App\SiteParserCore\Work\Builder\Adaptation\LiteralMapBuilder;
use App\SiteParserCore\Work\Builder\Adaptation\MapBuilder;
use App\SiteParserCore\Work\Service\Export\ExternalExportService;

class AdaptationSubscriber implements AdaptationInterface
{
    private $parameterGroupRepositoryProvider;
    private $mapBuilder;
    private $literalMapBuilder;
    private $externalExportService;

    public function __construct(
        ParameterGroupProvider $parameterGroupRepositoryProvider,
        MapBuilder $mapBuilder,
        LiteralMapBuilder $literalMapBuilder,
        ExternalExportService $externalExportService
    ) {
        $this->parameterGroupRepositoryProvider = $parameterGroupRepositoryProvider;
        $this->mapBuilder = $mapBuilder;
        $this->literalMapBuilder = $literalMapBuilder;
        $this->externalExportService = $externalExportService;
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
    public function subscribeBefore(EventInterface $event): void
    {
        /** @var ParameterGroup $parameterGroup */
        $parameterGroup = $this->parameterGroupRepositoryProvider
            ->provide()
            ->findOneBy(
                ['name' => Definition::GROUP_NAME],
                ['id' => 'DESC']
            );

        $mapResult = $this->mapBuilder->build($parameterGroup);
        $this->externalExportService->setName('google-search-results');
        $this->externalExportService->setData(ExternalExportAdapter::adaptMapBuilderResult($mapResult));
        $this->externalExportService->execute();

        $literalResult = $this->literalMapBuilder->build($parameterGroup);
        $this->externalExportService->setName('google-search-results-literal');
        $this->externalExportService->setData(ExternalExportAdapter::adaptLiteralMapBuilderResult($literalResult));
        $this->externalExportService->execute();
    }

    /**
     * @param AfterEvent $event
     */
    public function subscribeAfter(EventInterface $event): void
    {
    }
}
