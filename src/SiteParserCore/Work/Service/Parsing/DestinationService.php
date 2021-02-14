<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Service\Parsing;

use App\SiteParserCore\Resource\Entity\ORM\ParameterGroup;
use App\SiteParserCore\Work\Factory\ORM\Entity\GroupParametersFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterGroupFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterTreeFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ValueFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

class DestinationService
{
    public const BATCH_SIZE = 1000;
    public const PARAMETER_ROW_PREFIX = 'Row - ';

    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function createParameterGroup(string $parameterGroupName): ParameterGroup
    {
        $this->entityManager->beginTransaction();
        
        $parameterGroup = ParameterGroupFactory::createInline(null, $parameterGroupName);
        $this->entityManager->persist($parameterGroup);

        try {
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Throwable $t) {
            $this->entityManager->rollback();
            throw $t;
        }
        
        return $parameterGroup;
    }

    public function fillParameterGroup(ParameterGroup $parameterGroup, array $parameterRows): void
    {
        $parameterRowChunks = array_chunk($parameterRows, static::BATCH_SIZE);

        foreach ($parameterRowChunks as $parameterRowChunk) {
            $this->entityManager->beginTransaction();

            foreach ($parameterRowChunk as $parameterRow) {
                $this->appendParameterRowToGroup($parameterGroup, $parameterRow);
            }

            try {
                $this->entityManager->flush();
                $this->entityManager->commit();
            } catch (\Throwable $t) {
                $this->entityManager->rollback();
                throw $t;
            }
        }
    }

    /**
     * @param array $data = [
     *      <parameterName> => <value>,
     *      ...
     * ]
     */
    private function appendParameterRowToGroup(
        ParameterGroup $parameterGroup,
        array $data
    ): void {
        $rowParameter = ParameterFactory::createInline(null, static::PARAMETER_ROW_PREFIX . (string) Uuid::v6());
        $rowGroupParameter = GroupParametersFactory::createInline($parameterGroup, $rowParameter);
        $parameterGroup->addParameter($rowGroupParameter);

        $this->entityManager->persist($rowParameter);
        $this->entityManager->persist($rowGroupParameter);

        foreach ($data as $parameterName => $parameterValue) {
            $parameter = ParameterFactory::createInline(null, $parameterName);
            $parameterRelation = ParameterTreeFactory::createInline($rowParameter, $parameter);
            $rowParameter->addChildrenRelation($parameterRelation);
            $value = ValueFactory::createInline($parameter, null, (string) $parameterValue);
            $parameter->addValue($value);

            $this->entityManager->persist($parameter);
            $this->entityManager->persist($parameterRelation);
            $this->entityManager->persist($value);
        }
    }
}
