<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Destination;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;
use DateTime;

class DestinationFactory implements ORMEntityFactoryInterface
{
    public static function create(array $data = []): Destination
    {
        return static::fill(new Destination(), $data);
    }

    public static function createInline(...$entityParameters): Destination
    {
        return static::create([
            'output' => $entityParameters[0] ?? null,
            'creationDate' => $entityParameters[1] ?? null,
            'name' => $entityParameters[2] ?? null,
            'handlerNamespace' => $entityParameters[3] ?? null,
        ]);
    }

    private static function fill(Destination $entity, array $data): Destination
    {
        $entity->setOutput($data['output'] ?? ParameterFactory::create());
        $entity->setCreationDate($data['creationDate'] ?? new DateTime());
        $entity->setName($data['name'] ?? '');
        $entity->setHandlerNamespace($data['handlerNamespace'] ?? '');

        return $entity;
    }
}
