<?php declare(strict_types=1);
namespace App\Google\Work\Handler;

use App\Google\Business\Definition\SearchResultsInterface as Definition;
use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\Entity\HandlerArgumentInterface;
use App\SiteParserCore\Resource\Marker\Entity\HandlerResultInterface;
use App\SiteParserCore\Work\Factory\Handler\HandlerFactory;
use App\SiteParserCore\Work\Handler\HandlerInterface;
use App\SiteParserCore\Work\Service\DOMCrawler\ActionService;
use App\SiteParserCore\Work\Service\Parsing\DestinationService;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\DomCrawler\Crawler as PantherCrawler;
use Symfony\Component\DomCrawler\Crawler as DOMCrawler;
use Symfony\Component\String\Slugger\SluggerInterface;

class SearchResultsHandler implements HandlerInterface
{
    private $actionService;
    private $slugger;
    private $destinationService;

    public function __construct(
        ActionService $actionService,
        SluggerInterface $slugger,
        DestinationService $destinationService
    ) {
        $this->actionService = $actionService;
        $this->slugger = $slugger;
        $this->destinationService = $destinationService;
    }

    public function handleSource(Source $source, ?HandlerArgumentInterface $argument): HandlerResultInterface
    {
        $handlerResult = HandlerFactory::createResult(['data' => []]);

        $client = Client::createChromeClient();
        $client->request('GET', 'https://google.com');

        $searchKeyword = 'Co się dzieje w Polsce?';

        /** @var PantherCrawler $pantherCrawler */
        $pantherCrawler = $client->waitFor('input[name="q"]');
        $this->actionService->fillPantherCrawlerInput($pantherCrawler, 'input[name="q"]', $searchKeyword);

        $client->takeScreenshot('var/' . $this->slugger->slug($searchKeyword . ' - searching') . '.png');
        $client->executeScript('document.querySelector(\'input[aria-label="Szukaj w Google"]\').click()');
        
        /** @var PantherCrawler $pantherCrawler */
        $pantherCrawler = $client->waitFor('body');
        $client->takeScreenshot('var/' . $this->slugger->slug($searchKeyword . ' - search results') . '.png');

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
                Definition::SUBOUTPUT_NAME_URL => $url,
                Definition::SUBOUTPUT_NAME_TITLE => $title,
                Definition::SUBOUTPUT_NAME_RANDOM_NUMBER => rand(0, 1000)
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

        $resultItems = $argument->getHandlerResult()->getData('data') ?? [];
        $parameterGroup = $this->destinationService->createParameterGroup(Definition::GROUP_NAME);

        foreach ($resultItems as $item) {
            $this->destinationService->filleParameterGroup($parameterGroup, $item);
        }

        return HandlerFactory::createResult();
    }
}
