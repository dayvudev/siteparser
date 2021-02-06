<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Provider\ORM\Repository;

use App\SiteParserCore\Resource\Marker\ORMRepositoryProviderInterface;
use App\SiteParserCore\Resource\Repository\ORM\ParserTreeRepository;

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
