<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Source;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;
use DateTime;

class SourceFactory implements ORMEntityFactoryInterface
{
    public static function create(array $data = []): Source
    {
        return static::fill(new Source(), $data);
    }

    public static function createInline(...$entityParameters): Source
    {
        return static::create([
            'input' => $entityParameters[0] ?? null,
            'creationDate' => $entityParameters[1] ?? null,
            'name' => $entityParameters[2] ?? null,
            'handlerNamespace' => $entityParameters[3] ?? null,
        ]);
    }

    private static function fill(Source $entity, array $data): Source
    {
        $entity->setInput($data['input'] ?? ParameterFactory::create());
        $entity->setCreationDate($data['creationDate'] ?? new DateTime());
        $entity->setName($data['name'] ?? '');
        $entity->setHandlerNamespace($data['handlerNamespace'] ?? '');

        return $entity;
    }
}
