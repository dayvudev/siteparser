<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Service\Database;

use App\SiteParserCore\Business\Definition\Database\MigrationDefinitionInterface;
use Doctrine\ORM\EntityManagerInterface;

class MigrationRefreshService
{
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function execute(): void
    {
        $this->executeDownMigration();
        $this->executeUpMigration();
    }

    private function executeUpMigration(): void
    {
        $this->executeQueryList(MigrationDefinitionInterface::UP_QUERY_LIST);
    }

    private function executeDownMigration(): void
    {
        $this->executeQueryList(MigrationDefinitionInterface::DOWN_QUERY_LIST);
    }

    private function executeQueryList(array $queryList): void
    {
        $this->entityManager->clear();
        $this->entityManager->beginTransaction();

        foreach ($queryList as $query) {
            $this->entityManager->getConnection()->executeQuery($query);
        }

        try {
            $this->entityManager->commit();
        } catch (\Throwable $t) {
            $this->entityManager->rollback();
            throw $t;
        }

        $this->entityManager->clear();
    }
}
