<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Repository\ORM;

use App\SiteParserCore\Resource\Entity\ORM\ParserTree;
use App\SiteParserCore\Resource\Marker\Repository\ORMRepositoryInterface;
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
