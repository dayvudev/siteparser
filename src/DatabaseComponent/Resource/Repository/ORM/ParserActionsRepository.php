<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Repository\ORM;

use App\DatabaseComponent\Resource\Entity\ORM\ParserActions;
use App\DatabaseComponent\Resource\Marker\ORMRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParserActions|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParserActions|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParserActions[]    findAll()
 * @method ParserActions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParserActionsRepository extends ServiceEntityRepository implements ORMRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParserActions::class);
    }
}
