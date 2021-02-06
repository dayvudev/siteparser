<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker\Repository;

use App\SiteParserCore\Resource\Marker\MarkerInterface;
use App\SiteParserCore\Resource\Repository\RepositoryInterface;

interface ORMRepositoryInterface extends MarkerInterface, RepositoryInterface
{
    public const LOGIC_EXCEPTION_MESSAGE = self::class;
}
