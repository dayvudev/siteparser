<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Provider\ORM\Repository;

use App\SiteParserCore\Resource\Marker\Provider\ORMRepositoryProviderInterface;
use App\SiteParserCore\Resource\Repository\ORM\ParameterRepository;

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
