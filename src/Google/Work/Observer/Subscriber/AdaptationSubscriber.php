<?php declare(strict_types=1);
namespace App\Google\Work\Observer\Subscriber;

use Doctrine\ORM\EntityManagerInterface;
use App\SiteParserCore\Resource\Entity\ORM\Value;
use App\SiteParserCore\Business\Event\EventInterface;
use App\SiteParserCore\Resource\Entity\ORM\Parameter;
use App\SiteParserCore\Resource\Entity\ORM\ParameterTree;
use App\SiteParserCore\Resource\Entity\ORM\ParameterGroup;
use App\SiteParserCore\Resource\Entity\ORM\GroupParameters;
use App\SiteParserCore\Business\Event\Adaptation\AfterEvent;
use App\SiteParserCore\Business\Event\Adaptation\BeforeEvent;
use App\SiteParserCore\Work\Provider\ORM\Repository\ParameterProvider;
use App\SiteParserCore\Work\Provider\ORM\Repository\ParameterGroupProvider;
use App\SiteParserCore\Resource\Marker\Observer\Subscriber\AdaptationInterface;
use App\Google\Business\Definition\Configuration\SearchResultsInterface as Definition;

class AdaptationSubscriber implements AdaptationInterface
{
    private $entityManager;
    private $parameterGroupRepositoryProvider;

    public function __construct(
        EntityManagerInterface $entityManager,
        ParameterGroupProvider $parameterGroupRepositoryProvider
    ) {
        $this->entityManager = $entityManager;
        $this->parameterGroupRepositoryProvider = $parameterGroupRepositoryProvider;
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
        $parameterGroup = $this->parameterGroupRepositoryProvider->provide()->findOneByName(Definition::NAME_GROUP);

        $file1 = fopen('google-search-results1.csv', 'w');
        $file2 = fopen('google-search-results2.csv', 'w');
        $json = [];
        
        /** @var GroupParameters $groupParameters */
        foreach ($parameterGroup->getParameters() as $groupParameters) {
            /** @var ParameterTree $parameterTree */
            foreach ($groupParameters->getParameter()->getChildrenRelations() as $parameterTree) {
                $json[$parameterTree->getChild()->getName()] = $json[$parameterTree->getChild()->getName()] ?? [];

                /** @var Value $value */
                foreach ($parameterTree->getChild()->getValues() as $value) {
                    $json[$parameterTree->getChild()->getName()][$value->getValue()] = $value->getValue();
                }
            }
        }

        foreach ($json as $parameterName => $values) {
            $i = 1;
            $json[$parameterName] = [];

            foreach ($values as $value) {
                $json[$parameterName][$value] = $i++;
            }
        }
        
        /** @var GroupParameters $groupParameters */
        foreach ($parameterGroup->getParameters() as $groupParameters) {
            $values1 = [];
            $values2 = [];

            /** @var ParameterTree $parameterTree */
            foreach ($groupParameters->getParameter()->getChildrenRelations() as $parameterTree) {
                /** @var Value $value */
                foreach ($parameterTree->getChild()->getValues() as $value) {
                    $values1[$parameterTree->getChild()->getName()] = $value->getValue();
                    $values2[$parameterTree->getChild()->getName()] = $json[$parameterTree->getChild()->getName()][$value->getValue()];
                }
            }

            fputcsv($file1, $values1);
            fputcsv($file2, $values2);
        }

        fclose($file1);
        fclose($file2);
        file_put_contents('google-search-results.json', json_encode($json, JSON_PRETTY_PRINT));
    }

    /**
     * @param AfterEvent $event
     */
    public function subscribeAfter(EventInterface $event): void
    {
    }
}
