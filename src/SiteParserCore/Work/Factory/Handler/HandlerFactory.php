<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Handler;

use App\SiteParserCore\Resource\Entity\Handler\HandlerArgument;
use App\SiteParserCore\Resource\Entity\Handler\HandlerResult;
use App\SiteParserCore\Resource\Marker\Entity\HandlerArgumentInterface;
use App\SiteParserCore\Resource\Marker\Entity\HandlerResultInterface;
use App\SiteParserCore\Resource\Marker\Factory\HandlerEntityFactoryInterface;

class HandlerFactory implements HandlerEntityFactoryInterface
{
    public static function createArgument(array $data = []): HandlerArgumentInterface
    {
        return new HandlerArgument($data);
    }

    public static function createResult(array $data = []): HandlerResultInterface
    {
        return new HandlerResult($data);
    }
}
