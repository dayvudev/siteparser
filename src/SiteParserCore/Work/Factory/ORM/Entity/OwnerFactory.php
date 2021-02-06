<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\ORM\Entity;

use App\SiteParserCore\Resource\Entity\ORM\Owner;
use App\SiteParserCore\Resource\Marker\Factory\ORMEntityFactoryInterface;

class OwnerFactory implements ORMEntityFactoryInterface
{
    public static function create(): Owner
    {
        return new Owner();
    }
}
