<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Owner;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;
use DateTime;

class OwnerFactory implements ORMEntityFactoryInterface
{
    public static function create(array $data = []): Owner
    {
        return static::fill(new Owner(), $data);
    }

    public static function createInline(...$entityParameters): Owner
    {
        return static::create([
            'parser' => $entityParameters[0] ?? null,
            'creationDate' => $entityParameters[1] ?? null,
            'name' => $entityParameters[2] ?? null,
            'url' => $entityParameters[3] ?? null,
        ]);
    }

    private static function fill(Owner $entity, array $data): Owner
    {
        $entity->setParser($data['parser'] ?? ParserFactory::create());
        $entity->setCreationDate($data['creationDate'] ?? new DateTime());
        $entity->setName($data['name'] ?? '');
        $entity->setUrl($data['url'] ?? '');

        return $entity;
    }
}
