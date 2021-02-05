<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Provider\ORM\Repository;

use App\DatabaseComponent\Resource\Marker\ORMRepositoryProviderInterface;
use App\DatabaseComponent\Resource\Repository\ORM\DestinationRepository;

class DestinationProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(DestinationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): DestinationRepository
    {
        return $this->repository;
    }
}
