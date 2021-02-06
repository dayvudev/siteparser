<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Provider\ORM\Repository;

use App\SiteParserCore\Resource\Marker\ORMRepositoryProviderInterface;
use App\SiteParserCore\Resource\Repository\ORM\ParserActionsRepository;

class ParserActionsProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(ParserActionsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): ParserActionsRepository
    {
        return $this->repository;
    }
}
