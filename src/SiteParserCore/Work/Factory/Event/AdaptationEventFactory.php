<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Event;

use App\SiteParserCore\Business\Event\Adaptation\AfterEvent;
use App\SiteParserCore\Business\Event\Adaptation\BeforeEvent;
use App\SiteParserCore\Resource\Marker\Factory\Event\AdaptationInterface;

class AdaptationEventFactory implements AdaptationInterface
{
    public static function createBefore(): BeforeEvent
    {
        return new BeforeEvent();
    }

    public static function createAfter(): AfterEvent
    {
        return new AfterEvent();
    }
}
