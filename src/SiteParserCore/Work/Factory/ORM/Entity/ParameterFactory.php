<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Parameter;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;
use DateTime;

class ParameterFactory implements ORMEntityFactoryInterface
{
    public static function create(array $data = []): Parameter
    {
        return static::fill(new Parameter(), $data);
    }

    public static function createInline(...$entityParameters): Parameter
    {
        return static::create([
            'creationDate' => $entityParameters[0] ?? null,
            'name' => $entityParameters[1] ?? null,
        ]);
    }

    private static function fill(Parameter $entity, array $data): Parameter
    {
        $entity->setCreationDate($data['creationDate'] ?? new DateTime());
        $entity->setName($data['name'] ?? '');

        return $entity;
    }
}
