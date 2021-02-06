<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Provider\ORM\Repository;

use App\SiteParserCore\Resource\Marker\Provider\ORMRepositoryProviderInterface;
use App\SiteParserCore\Resource\Repository\ORM\ActionRepository;

class ActionProvider implements ORMRepositoryProviderInterface
{
    private $repository;

    public function __construct(ActionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function provide(): ActionRepository
    {
        return $this->repository;
    }
}
