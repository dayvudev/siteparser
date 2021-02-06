<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Provider;

use App\SiteParserCore\Resource\Marker\MarkerInterface;
use App\SiteParserCore\Resource\Marker\Repository\ORMRepositoryInterface;
use App\SiteParserCore\Work\Provider\ProviderInterface;

interface ORMRepositoryProviderInterface extends MarkerInterface, ProviderInterface
{
    public function provide(): ORMRepositoryInterface;
}
