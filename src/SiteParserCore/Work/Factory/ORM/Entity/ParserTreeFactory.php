<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\ParserTree;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;
use DateTime;

class ParserTreeFactory implements ORMEntityFactoryInterface
{
    public static function create(array $data = []): ParserTree
    {
        return static::fill(new ParserTree(), $data);
    }

    public static function createInline(...$entityParameters): ParserTree
    {
        return static::create([
            'parent' => $entityParameters[0] ?? null,
            'child' => $entityParameters[1] ?? null,
            'creationDate' => $entityParameters[2] ?? null,
        ]);
    }

    private static function fill(ParserTree $entity, array $data): ParserTree
    {
        $entity->setParent($data['parent'] ?? ParserFactory::create());
        $entity->setChild($data['child'] ?? ParserFactory::create());
        $entity->setCreationDate($data['creationDate'] ?? new DateTime());

        return $entity;
    }
}
