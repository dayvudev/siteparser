<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\ParameterGroup;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;
use DateTime;

class ParameterGroupFactory implements ORMEntityFactoryInterface
{
    public static function create(array $data = []): ParameterGroup
    {
        return static::fill(new ParameterGroup(), $data);
    }

    public static function createInline(...$entityParameters): ParameterGroup
    {
        return static::create([
            'creationDate' => $entityParameters[0] ?? null,
            'name' => $entityParameters[1] ?? null,
        ]);
    }

    private static function fill(ParameterGroup $entity, array $data): ParameterGroup
    {
        $entity->setCreationDate($data['creationDate'] ?? new DateTime());
        $entity->setName($data['name'] ?? '');

        return $entity;
    }
}
