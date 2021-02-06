<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Action;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;
use DateTime;

class ActionFactory implements ORMEntityFactoryInterface
{
    public static function create(array $data = []): Action
    {
        return static::fill(new Action(), $data);
    }

    public static function createInline(...$entityParameters): Action
    {
        return static::create([
            'source' => $entityParameters[0] ?? null,
            'destination' => $entityParameters[1] ?? null,
            'creationDate' => $entityParameters[2] ?? null,
            'name' => $entityParameters[3] ?? null,
            'handlerNamespace' => $entityParameters[4] ?? null,
            'sortOrder' => $entityParameters[5] ?? null,
            'isDisable' => $entityParameters[6] ?? null,
        ]);
    }

    private static function fill(Action $entity, array $data): Action
    {
        $entity->setSource($data['source'] ?? SourceFactory::create());
        $entity->setDestination($data['destination'] ?? DestinationFactory::create());
        $entity->setCreationDate($data['creationDate'] ?? new DateTime());
        $entity->setName($data['name'] ?? '');
        $entity->setHandlerNamespace($data['handlerNamespace'] ?? '');
        $entity->setSortOrder($data['sortOrder'] ?? 0);
        $entity->setIsDisable($data['isDisable'] ?? false);

        return $entity;
    }
}
