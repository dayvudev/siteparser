<?php declare(strict_types=1);
namespace App\DatabaseComponent\Work\Factory\ORM;

use App\DatabaseComponent\Resource\Entity\ORM\Source;
use App\DatabaseComponent\Resource\Marker\ORMEntityFactoryInterface;

class SourceFactory implements ORMEntityFactoryInterface
{
    public static function create(): Source
    {
        return new Source();
    }
}
