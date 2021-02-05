<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Provider\ORM\Repository;

use App\DatabaseComponent\Resource\Marker\ORMRepositoryProviderInterface;
use App\DatabaseComponent\Resource\Repository\ORM\ActionRepository;

class ActionProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(ActionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): ActionRepository
    {
        return $this->repository;
    }
}
