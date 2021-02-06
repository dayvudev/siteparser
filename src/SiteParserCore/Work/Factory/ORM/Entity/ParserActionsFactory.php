<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\ParserActions;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;
use DateTime;

class ParserActionsFactory implements ORMEntityFactoryInterface
{
    public static function create(array $data = []): ParserActions
    {
        return static::fill(new ParserActions(), $data);
    }

    public static function createInline(...$entityParameters): ParserActions
    {
        return static::create([
            'parser' => $entityParameters[0] ?? null,
            'action' => $entityParameters[1] ?? null,
            'creationDate' => $entityParameters[2] ?? null,
        ]);
    }

    private static function fill(ParserActions $entity, array $data): ParserActions
    {
        $entity->setParser($data['parser'] ?? ParserFactory::create());
        $entity->setAction($data['action'] ?? ActionFactory::create());
        $entity->setCreationDate($data['creationDate'] ?? new DateTime());

        return $entity;
    }
}
