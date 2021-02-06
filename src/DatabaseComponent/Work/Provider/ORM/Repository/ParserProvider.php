<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Provider\ORM\Repository;

use App\SiteParserCore\Resource\Marker\ORMRepositoryProviderInterface;
use App\SiteParserCore\Resource\Repository\ORM\ParserRepository;

class ParserProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(ParserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): ParserRepository
    {
        return $this->repository;
    }
}
