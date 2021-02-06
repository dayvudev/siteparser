<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Provider\ORM\Repository;

use App\SiteParserCore\Resource\Marker\Provider\ORMRepositoryProviderInterface;
use App\SiteParserCore\Resource\Repository\ORM\ParameterTreeRepository;

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
