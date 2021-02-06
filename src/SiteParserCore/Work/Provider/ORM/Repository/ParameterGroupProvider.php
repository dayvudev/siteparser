<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Provider\ORM\Repository;

use App\SiteParserCore\Resource\Marker\Provider\ORMRepositoryProviderInterface;
use App\SiteParserCore\Resource\Repository\ORM\ParameterGroupRepository;

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
