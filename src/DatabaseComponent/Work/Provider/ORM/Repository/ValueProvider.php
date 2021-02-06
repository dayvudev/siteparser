<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Provider\ORM\Repository;

use App\SiteParserCore\Resource\Marker\ORMRepositoryProviderInterface;
use App\SiteParserCore\Resource\Repository\ORM\ValueRepository;

class ValueProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(ValueRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): ValueRepository
    {
        return $this->repository;
    }
}
