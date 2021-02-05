<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Provider\ORM\Repository;

use App\DatabaseComponent\Resource\Marker\ORMRepositoryProviderInterface;
use App\DatabaseComponent\Resource\Repository\ORM\ParameterRepository;

class ParameterProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(ParameterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): ParameterRepository
    {
        return $this->repository;
    }
}