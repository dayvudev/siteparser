<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Provider\ORM\Repository;

use App\DatabaseComponent\Resource\Marker\ORMRepositoryProviderInterface;
use App\DatabaseComponent\Resource\Repository\ORM\ParameterGroupRepository;

class ParameterGroupProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(ParameterGroupRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): ParameterGroupRepository
    {
        return $this->repository;
    }
}
