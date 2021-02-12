<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Service\Parsing;

use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Entity\ORM\ParameterGroup;
use App\SiteParserCore\Work\Factory\ORM\Entity\GroupParametersFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterGroupFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ParameterTreeFactory;
use App\SiteParserCore\Work\Factory\ORM\Entity\ValueFactory;
use App\SiteParserCore\Work\Provider\ORM\Repository\ParameterGroupProvider;
use Doctrine\ORM\EntityManagerInterface;

class DestinationService
{
    private $entityManager;
    private $parameterGroupRepositoryProvider;

    public function __construct(
        EntityManagerInterface $entityManager,
        ParameterGroupProvider $parameterGroupRepositoryProvider
    ) {
        $this->entityManager = $entityManager;
        $this->parameterGroupRepositoryProvider = $parameterGroupRepositoryProvider;
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

    /**
     * @param array $data = [
     *      <parameterName> => <value>,
     *      ...
     * ]
     */
    public function filleParameterGroup(
        ParameterGroup $parameterGroup,
        array $data
    ): ParameterGroup {
        $this->entityManager->beginTransaction();

        $rowParameter = ParameterFactory::createInline(null, 'Row');
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

        try {
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Throwable $t) {
            $this->entityManager->rollback();
            throw $t;
        }
        
        return $parameterGroup;
    }
}
