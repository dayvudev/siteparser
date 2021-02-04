<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Repository\ORM;

use App\DatabaseComponent\Resource\Entity\ORM\GroupParameters;
use App\DatabaseComponent\Resource\Marker\ORMRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupParameters|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupParameters|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupParameters[]    findAll()
 * @method GroupParameters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupParametersRepository extends ServiceEntityRepository implements ORMRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupParameters::class);
    }
}