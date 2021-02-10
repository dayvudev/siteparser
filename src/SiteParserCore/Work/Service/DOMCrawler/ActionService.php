<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Service\DOMCrawler;

use DOMElement;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Symfony\Component\DomCrawler\Crawler as DOMCrawler;
use Symfony\Component\Panther\DomCrawler\Crawler as PantherCrawler;

class ActionService
{
    public function fillDOMCrawlerInput(DOMCrawler $crawler, string $selector, string $value): DOMCrawler
    {
        /** @var DOMCrawler $crawler */
        $crawler = $crawler->filter('input.message')->first();
        /** @var DOMElement $input */
        $input = $crawler->getNode(0);

        $input->setAttribute('value', $value);

        return $crawler;
    }

    public function fillPantherCrawlerInput(PantherCrawler $crawler, string $selector, string $value): PantherCrawler
    {
        /** @var RemoteWebElement $element */
        $element = $crawler->filter($selector)->getElement(0);
        
        $element->sendKeys($value);

        return $crawler;
    }
}
