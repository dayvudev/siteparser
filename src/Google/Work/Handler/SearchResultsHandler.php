<?php declare(strict_types=1);
namespace App\Google\Work\Handler;

use App\Google\Business\Definition\SearchResultsInterface as Definition;
use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\GroupParameters;
use App\SiteParserCore\Resource\Entity\ORM\ParameterTree;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\Entity\HandlerArgumentInterface;
use App\SiteParserCore\Resource\Marker\Entity\HandlerResultInterface;
use App\SiteParserCore\Work\Factory\Handler\HandlerFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\GroupParametersFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterGroupFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterTreeFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ValueFactory;
use App\SiteParserCore\Work\Handler\HandlerInterface;
use App\SiteParserCore\Work\Service\DOMCrawler\ActionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\DomCrawler\Crawler as PantherCrawler;
use Symfony\Component\DomCrawler\Crawler as DOMCrawler;
use Throwable;

class SearchResultsHandler implements HandlerInterface
{
    private $entityManager;
    private $actionService;

    public function __construct(
        EntityManagerInterface $entityManager,
        ActionService $actionService
    ) {
        $this->entityManager = $entityManager;
        $this->actionService = $actionService;
    }

    public function handleSource(Source $source, ?HandlerArgumentInterface $argument): HandlerResultInterface
    {
        $handlerResult = HandlerFactory::createResult(['data' => []]);

        $client = Client::createChromeClient();
        $client->request('GET', 'https://google.com');

        $searchKeyword = 'Site Parser';

        /** @var PantherCrawler $pantherCrawler */
        $pantherCrawler = $client->waitFor('input[name="q"]');
        $this->actionService->fillPantherCrawlerInput($pantherCrawler, 'input[name="q"]', $searchKeyword);

        $client->takeScreenshot($searchKeyword . ' - searching.png');
        $client->executeScript('document.querySelector(\'input[aria-label="Szukaj w Google"]\').click()');
        
        /** @var PantherCrawler $pantherCrawler */
        $pantherCrawler = $client->waitFor('body');
        $client->takeScreenshot($searchKeyword . ' - search results.png');

        /** @var RemoteWebElement $element */
        $searchResultContainer = $pantherCrawler->filter('#search > div:first-of-type > div:first-of-type');

        /** @var DOMCrawler $element */
        $crawler = new DOMCrawler($searchResultContainer->html());
        /** @var DOMElement */
        foreach ($crawler->filter('.g') as $item) {
            $subCrawler = new DOMCrawler($item);

            $url = $subCrawler->filter('div:first-of-type > div:first-of-type > a')->first()->attr('href');
            $title = $subCrawler->filter('div:first-of-type > div:first-of-type > a > h3')->first()->text();

            $data = $handlerResult->getData('data');
            $data[] = [
                'url' => $url,
                'title' => $title
            ];
            $handlerResult->setData('data', $data);
        }
        
        return $handlerResult;
    }

    public function handleDestination(Destination $destination, ?HandlerArgumentInterface $argument): HandlerResultInterface
    {
        if (! $argument instanceof HandlerArgumentInterface
        ||  ! $argument->getHandlerResult() instanceof HandlerResultInterface)
        {
            return HandlerFactory::createResult();
        }

        $this->entityManager->beginTransaction();

        $resultItems = $argument->getHandlerResult()->getData('data') ?? [];

        $group = ParameterGroupFactory::createInline(null, Definition::GROUP_NAME);

        $this->entityManager->persist($group);

        $i = 1;
        foreach ($resultItems as $item) {
            $rowParameter = ParameterFactory::createInline(null, 'Parameter Row (' . $i . ')');
            $rowParameterGroup = GroupParametersFactory::createInline($group, $rowParameter);
            $parameterRelation = ParameterTreeFactory::createInline($destination->getOutput(), $rowParameter);
            $titleParameter = ParameterFactory::createInline(null, Definition::SUBOUTPUT_NAME_TITLE);
            $urlParameter = ParameterFactory::createInline(null, Definition::SUBOUTPUT_NAME_URL);
            $titleParameterRelation = ParameterTreeFactory::createInline($rowParameter, $titleParameter);
            $urlParameterRelation = ParameterTreeFactory::createInline($rowParameter, $urlParameter);

            $title = ValueFactory::createInline($titleParameter, null, $item['title']);
            $url = ValueFactory::createInline($urlParameter, null, $item['url']);

            $this->entityManager->persist($rowParameter);
            $this->entityManager->persist($rowParameterGroup);
            $this->entityManager->persist($parameterRelation);
            $this->entityManager->persist($titleParameter);
            $this->entityManager->persist($urlParameter);
            $this->entityManager->persist($titleParameterRelation);
            $this->entityManager->persist($urlParameterRelation);
            $this->entityManager->persist($title);
            $this->entityManager->persist($url);

            $i++;
        }

        try {
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (Throwable $t) {
            $this->entityManager->rollback();
            throw $t;
        }

        return HandlerFactory::createResult();
    }
}
