<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Factory;

use App\SiteParserCore\Resource\Marker\Entity\HandlerArgumentInterface;
use App\SiteParserCore\Resource\Marker\Entity\HandlerResultInterface;
use App\SiteParserCore\Resource\Marker\MarkerInterface;
use App\SiteParserCore\Work\Factory\FactoryInterface;

interface HandlerEntityFactoryInterface extends MarkerInterface, FactoryInterface
{
    public static function createArgument(array $data = []): HandlerArgumentInterface;
    public static function createResult(array $data = []): HandlerResultInterface;
}
