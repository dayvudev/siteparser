<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Repository\ORM;

use App\DatabaseComponent\Resource\Entity\ORM\Source;
use App\DatabaseComponent\Resource\Marker\ORMRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Source|null find($id, $lockMode = null, $lockVersion = null)
 * @method Source|null findOneBy(array $criteria, array $orderBy = null)
 * @method Source[]    findAll()
 * @method Source[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourceRepository extends ServiceEntityRepository implements ORMRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Source::class);
    }
}
