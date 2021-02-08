<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Handler;

use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\Entity\HandlerArgumentInterface;
use App\SiteParserCore\Resource\Marker\Entity\HandlerResultInterface;
use App\SiteParserCore\Work\WorkInterface;

interface HandlerInterface extends WorkInterface
{
    public function handleSource(Source $source, ?HandlerArgumentInterface $argument): HandlerResultInterface;
    public function handleDestination(Destination $destination, ?HandlerArgumentInterface $argument): HandlerResultInterface;
}
