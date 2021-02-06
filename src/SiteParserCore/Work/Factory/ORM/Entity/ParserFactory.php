<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Parser;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;
use DateTime;

class ParserFactory implements ORMEntityFactoryInterface
{
    public static function create(array $data = []): Parser
    {
        return static::fill(new Parser(), $data);
    }

    public static function createInline(...$entityParameters): Parser
    {
        return static::create([
            'creationDate' => $entityParameters[0] ?? null,
            'name' => $entityParameters[1] ?? null,
            'sortOrder' => $entityParameters[2] ?? null,
            'isDisable' => $entityParameters[3] ?? null,
        ]);
    }

    private static function fill(Parser $entity, array $data): Parser
    {
        $entity->setCreationDate($data['creationDate'] ?? new DateTime());
        $entity->setName($data['name'] ?? '');
        $entity->setSortOrder($data['sortOrder'] ?? 0);
        $entity->setIsDisable($data['isDisable'] ?? false);

        return $entity;
    }
}
