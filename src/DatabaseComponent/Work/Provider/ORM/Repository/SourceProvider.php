<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Provider\ORM\Repository;

use App\DatabaseComponent\Resource\Marker\ORMRepositoryProviderInterface;
use App\DatabaseComponent\Resource\Repository\ORM\SourceRepository;

class SourceProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(SourceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): SourceRepository
    {
        return $this->repository;
    }
}
