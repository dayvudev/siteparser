<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Repository\ORM;

use App\SiteParserCore\Resource\Entity\ORM\ParameterTree;
use App\SiteParserCore\Resource\Marker\ORMRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParameterTree|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParameterTree|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParameterTree[]    findAll()
 * @method ParameterTree[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParameterTreeRepository extends ServiceEntityRepository implements ORMRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParameterTree::class);
    }
}
