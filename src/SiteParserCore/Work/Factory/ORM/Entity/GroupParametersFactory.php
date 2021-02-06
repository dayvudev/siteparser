<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\GroupParameters;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;
use DateTime;

class GroupParametersFactory implements ORMEntityFactoryInterface
{
    public static function create(array $data = []): GroupParameters
    {
        return static::fill(new GroupParameters(), $data);
    }

    public static function createInline(...$entityParameters): GroupParameters
    {
        return static::create([
            'group' => $entityParameters[0] ?? null,
            'parameter' => $entityParameters[1] ?? null,
            'creationDate' => $entityParameters[2] ?? null,
        ]);
    }

    private static function fill(GroupParameters $entity, array $data): GroupParameters
    {
        $entity->setGroup($data['group'] ?? ParameterGroupFactory::create());
        $entity->setParameter($data['parameter'] ?? ParameterFactory::create());
        $entity->setCreationDate($data['creationDate'] ?? new DateTime());

        return $entity;
    }
}
