<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Provider\ORM\Repository;

use App\SiteParserCore\Resource\Marker\ORMRepositoryProviderInterface;
use App\SiteParserCore\Resource\Repository\ORM\GroupParametersRepository;

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
