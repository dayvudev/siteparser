<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Provider\ORM\Repository;

use App\SiteParserCore\Resource\Marker\ORMRepositoryProviderInterface;
use App\SiteParserCore\Resource\Repository\ORM\OwnerRepository;

class OwnerProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(OwnerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): OwnerRepository
    {
        return $this->repository;
    }
}
