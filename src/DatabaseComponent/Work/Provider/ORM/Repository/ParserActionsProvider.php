<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Provider\ORM\Repository;

use App\DatabaseComponent\Resource\Marker\ORMRepositoryProviderInterface;
use App\DatabaseComponent\Resource\Repository\ORM\ParserActionsRepository;

class ParserActionsProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(ParserActionsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): ParserActionsRepository
    {
        return $this->repository;
    }
}
