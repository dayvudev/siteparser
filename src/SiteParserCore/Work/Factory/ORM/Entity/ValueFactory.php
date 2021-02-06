<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Value;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;
use DateTime;

class ValueFactory implements ORMEntityFactoryInterface
{
    public static function create(array $data = []): Value
    {
        return static::fill(new Value(), $data);
    }

    public static function createInline(...$entityParameters): Value
    {
        return static::create([
            'parameter' => $entityParameters[0] ?? null,
            'creationDate' => $entityParameters[1] ?? null,
            'value' => $entityParameters[2] ?? null,
        ]);
    }

    private static function fill(Value $entity, array $data): Value
    {
        $entity->setParameter($data['parameter'] ?? ParameterFactory::create());
        $entity->setCreationDate($data['creationDate'] ?? new DateTime());
        $entity->setValue($data['value'] ?? '');

        return $entity;
    }
}
