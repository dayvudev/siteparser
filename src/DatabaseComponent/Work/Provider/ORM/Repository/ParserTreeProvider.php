<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Provider\ORM\Repository;

use App\DatabaseComponent\Resource\Marker\ORMRepositoryProviderInterface;
use App\DatabaseComponent\Resource\Repository\ORM\ParserTreeRepository;

class ParserTreeProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(ParserTreeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): ParserTreeRepository
    {
        return $this->repository;
    }
}
