<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Provider\ORM\Repository;

use App\DatabaseComponent\Resource\Marker\ORMRepositoryProviderInterface;
use App\DatabaseComponent\Resource\Repository\ORM\GroupParametersRepository;

class GroupParametersProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(GroupParametersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): GroupParametersRepository
    {
        return $this->repository;
    }
}
