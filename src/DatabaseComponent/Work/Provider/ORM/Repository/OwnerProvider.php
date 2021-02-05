<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Provider\ORM\Repository;

use App\DatabaseComponent\Resource\Marker\ORMRepositoryProviderInterface;
use App\DatabaseComponent\Resource\Repository\ORM\OwnerRepository;

class OwnerProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(OwnerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): OwnerRepository
    {
        return $this->repository;
    }
}
