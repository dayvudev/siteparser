<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Repository\ORM;

use App\DatabaseComponent\Resource\Entity\ORM\ParserTree;
use App\DatabaseComponent\Resource\Marker\ORMRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParserTree|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParserTree|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParserTree[]    findAll()
 * @method ParserTree[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParserTreeRepository extends ServiceEntityRepository implements ORMRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParserTree::class);
    }
}
