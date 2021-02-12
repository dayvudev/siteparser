<?php declare(strict_types=1);
namespace App\Google\Work\Handler;

use App\SiteParserCore\Work\Handler\HandlerInterface;
use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\Entity\HandlerArgumentInterface;
use App\SiteParserCore\Resource\Marker\Entity\HandlerResultInterface;
use App\SiteParserCore\Work\Factory\Handler\HandlerFactory;

class DefaultHandler implements HandlerInterface
{
    public function handleSource(Source $source, ?HandlerArgumentInterface $argument): HandlerResultInterface
    {
        return HandlerFactory::createResult();
    }

    public function handleDestination(Destination $destination, ?HandlerArgumentInterface $argument): HandlerResultInterface
    {
        return HandlerFactory::createResult();
    }
}
