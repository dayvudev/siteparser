<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Marker;

use App\DatabaseComponent\Work\Provider\ProviderInterface;

interface ORMRepositoryProviderInterface extends MarkerInterface, ProviderInterface
{
    public function provide(): ORMRepositoryInterface;
}
