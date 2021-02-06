<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Provider\ORM\Repository;

use App\SiteParserCore\Resource\Marker\ORMRepositoryProviderInterface;
use App\SiteParserCore\Resource\Repository\ORM\SourceRepository;

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
