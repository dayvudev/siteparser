<?php declare(strict_types=1);
namespace App\Google\Work\Handler;

use App\SiteParserCore\Work\Handler\HandlerInterface;
use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\Entity\HandlerArgumentInterface;
use App\SiteParserCore\Resource\Marker\Entity\HandlerResultInterface;
use App\SiteParserCore\Work\Factory\Handler\HandlerFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ValueFactory;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;

class DefaultHandler implements HandlerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handleSource(Source $source, ?HandlerArgumentInterface $argument): HandlerResultInterface
    {
        return HandlerFactory::createResult();
    }

    public function handleDestination(Destination $destination, ?HandlerArgumentInterface $argument): HandlerResultInterface
    {
        $this->entityManager->beginTransaction();

        $value = ValueFactory::createInline($destination->getOutput(), null, '010101010101010101');
        $this->entityManager->persist($value);

        try {
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (Throwable $t) {
            $this->entityManager->rollback();
        }

        return HandlerFactory::createResult();
    }
}
