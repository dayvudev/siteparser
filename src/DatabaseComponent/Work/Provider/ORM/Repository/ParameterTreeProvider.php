<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Provider\ORM\Repository;

use App\DatabaseComponent\Resource\Marker\ORMRepositoryProviderInterface;
use App\DatabaseComponent\Resource\Repository\ORM\ParameterTreeRepository;

class ParameterTreeProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(ParameterTreeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): ParameterTreeRepository
    {
        return $this->repository;
    }
}
