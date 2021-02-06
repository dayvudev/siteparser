<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker;

use App\SiteParserCore\Work\Provider\ProviderInterface;

interface ORMRepositoryProviderInterface extends MarkerInterface, ProviderInterface
{
    public function provide(): ORMRepositoryInterface;
}
