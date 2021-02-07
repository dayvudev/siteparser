<?php declare(strict_types=1);
namespace App\Google\Work\Service\SearchResults;

use LogicException;
use Doctrine\ORM\EntityManagerInterface;
use App\SiteParserCore\Resource\Entity\ORM\Value;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Entity\ORM\Parameter;
use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\ParameterTree;
use App\GoogleSearchResultsScenario\Work\Service\ServiceInterface;
use App\Google\Business\Definition\Configuration\SearchResultsInterface as Definition;

class ParsingService implements ServiceInterface
{
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function execute(Source $source, Destination $destination): void
    {
        /** @var Parameter $keywordParameter */
        $keywordParameter = null;
        /** @var Parameter $urlParameter */
        $urlParameter = null;

        /** @var ParameterTree $relation */
        foreach ($source->getInput()->getChildrenRelations as $relation) {
            if (Definition::NAME_INPUT_KEYWORDS === $relation->getChild()->getName()) {
                $keywordParameter = $relation->getChild();
            }
            if (Definition::NAME_INPUT_SEARCH_URL === $relation->getChild()->getName()) {
                $urlParameter = $relation->getChild();
            }
        }

        if (! $keywordParameter instanceof Parameter || ! $urlParameter instanceof Parameter) {
            throw new LogicException();
        }

        /** @var Value $value */
        foreach ($urlParameter->getValues() as $value) {

        }
    }
}
