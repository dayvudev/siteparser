<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker;

use App\SiteParserCore\Work\Factory\FactoryInterface;

interface ExecutionEventFactoryInterface extends MarkerInterface, FactoryInterface
{
    public static function create(): ExecutionEventInterface;
}
