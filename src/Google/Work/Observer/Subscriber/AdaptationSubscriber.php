<?php declare(strict_types=1);
namespace App\Google\Work\Observer\Subscriber;

use Doctrine\ORM\EntityManagerInterface;
use App\SiteParserCore\Resource\Entity\ORM\Value;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Entity\ORM\ParameterTree;
use App\SiteParserCore\Resource\Entity\ORM\ParameterGroup;
use App\SiteParserCore\Resource\Entity\ORM\GroupParameters;
use App\SiteParserCore\Business\Event\Adaptation\AfterEvent;
use App\SiteParserCore\Business\Event\Adaptation\BeforeEvent;
use App\SiteParserCore\Work\Provider\ORM\Repository\ParameterGroupProvider;
use App\SiteParserCore\Resource\Marker\Observer\Subscriber\AdaptationInterface;
use App\Google\Business\Definition\SearchResultsInterface as Definition;
use App\SiteParserCore\Work\Builder\Adaptation\LiteralMapBuilder;
use App\SiteParserCore\Work\Builder\Adaptation\MapBuilder;

class AdaptationSubscriber implements AdaptationInterface
{
    private $entityManager;
    private $parameterGroupRepositoryProvider;
    private $mapBuilder;
    private $literalMapBuilder;

    public function __construct(
        EntityManagerInterface $entityManager,
        ParameterGroupProvider $parameterGroupRepositoryProvider,
        MapBuilder $mapBuilder,
        LiteralMapBuilder $literalMapBuilder
    ) {
        $this->entityManager = $entityManager;
        $this->parameterGroupRepositoryProvider = $parameterGroupRepositoryProvider;
        $this->mapBuilder = $mapBuilder;
        $this->literalMapBuilder = $literalMapBuilder;
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
        $parameterGroup = $this->parameterGroupRepositoryProvider->provide()->findOneBy([
            'name' => Definition::GROUP_NAME
        ], [
            'id' => 'DESC'
        ]);

        $mapResult = $this->mapBuilder->build($parameterGroup);

        $file1 = fopen('google-search-results1.csv', 'w');
        foreach ($mapResult as $rowName => $values) {
            fputcsv($file1, array_values($values));
        }
        fclose($file1);

        $literalResult = $this->literalMapBuilder->build($parameterGroup);

        $file1 = fopen('google-search-results2.csv', 'w');
        foreach ($literalResult['map'] as $rowName => $values) {
            fputcsv($file1, array_values($values));
        }
        fclose($file1);

        file_put_contents('google-search-results.json', json_encode($literalResult['legend'], JSON_PRETTY_PRINT));

        // $file1 = fopen('google-search-results1.csv', 'w');
        // $file2 = fopen('google-search-results2.csv', 'w');
        // $json = [];

        // fputcsv($file1, $values1);
        // fputcsv($file2, $values2);
        
        // fclose($file1);
        // fclose($file2);
        // file_put_contents('google-search-results.json', json_encode($json, JSON_PRETTY_PRINT));
    }

    /**
     * @param AfterEvent $event
     */
    public function subscribeAfter(EventInterface $event): void
    {
    }
}
