<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Factory\Handler;

use App\SiteParserCore\Resource\Entity\Handler\HandlerArgument;
use App\SiteParserCore\Resource\Entity\Handler\HandlerResult;
use App\SiteParserCore\Resource\Marker\Entity\HandlerArgumentInterface;
use App\SiteParserCore\Resource\Marker\Entity\HandlerResultInterface;
use App\SiteParserCore\Resource\Marker\Factory\HandlerEntityFactoryInterface;

class HandlerFactory implements HandlerEntityFactoryInterface
{
    public static function createArgument(array $data = [], ?HandlerResultInterface $handlerResult = null): HandlerArgumentInterface
    {
        $entity = new HandlerArgument($data);

        if ($handlerResult instanceof HandlerResultInterface) {
            $entity->setHandlerResult($handlerResult);
        }

        return $entity;
    }

    public static function createResult(array $data = []): HandlerResultInterface
    {
        return new HandlerResult($data);
    }
}
