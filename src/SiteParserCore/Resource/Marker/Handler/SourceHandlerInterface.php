<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Handler;

use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\Event\AdaptationEventInterface;
use App\SiteParserCore\Resource\Marker\MarkerInterface;
use App\SiteParserCore\Work\Handler\HandlerInterface;

interface SourceHandlerInterface extends MarkerInterface, HandlerInterface
{
    public static function handle(Source $source): void;
}
