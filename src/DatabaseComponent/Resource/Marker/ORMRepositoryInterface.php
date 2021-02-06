<?php declare(strict_types=1);
namespace App\SiteParserCore\Resource\Marker;

use App\SiteParserCore\Resource\Repository\RepositoryInterface;

interface ORMRepositoryInterface extends MarkerInterface, RepositoryInterface
{
    public const LOGIC_EXCEPTION_MESSAGE = self::class;
}
