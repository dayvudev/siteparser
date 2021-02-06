<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\ParameterTree;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;
use DateTime;

class ParameterTreeFactory implements ORMEntityFactoryInterface
{
    public static function create(array $data = []): ParameterTree
    {
        return static::fill(new ParameterTree(), $data);
    }

    public static function createInline(...$entityParameters): ParameterTree
    {
        return static::create([
            'parent' => $entityParameters[0] ?? null,
            'child' => $entityParameters[1] ?? null,
            'creationDate' => $entityParameters[2] ?? null,
        ]);
    }

    private static function fill(ParameterTree $entity, array $data): ParameterTree
    {
        $entity->setParent($data['parent'] ?? ParameterFactory::create());
        $entity->setChild($data['child'] ?? ParameterFactory::create());
        $entity->setCreationDate($data['creationDate'] ?? new DateTime());

        return $entity;
    }
}
