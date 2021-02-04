<?php declare(strict_types=1);
namespace App\DatabaseComponent\Resource\Marker;

use App\DatabaseComponent\Resource\Repository\RepositoryInterface;

interface ORMRepositoryInterface extends MarkerInterface, RepositoryInterface
{
    public const LOGIC_EXCEPTION_MESSAGE = self::class;
}
