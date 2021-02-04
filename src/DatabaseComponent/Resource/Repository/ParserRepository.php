<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Repository;

use App\DatabaseComponent\Resource\Entity\Parser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Parser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parser[]    findAll()
 * @method Parser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parser::class);
    }
}
