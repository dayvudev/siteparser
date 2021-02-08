<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Provider;

use App\SiteParserCore\Work\Handler\HandlerInterface;
use Exception;
use Symfony\Component\HttpKernel\KernelInterface;

class HandlerProvider implements ProviderInterface
{
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function provide(string $handlerNamespace): HandlerInterface
    {
        if (! class_exists($handlerNamespace)) {
            throw new Exception('Missing handler!');
        }

        $handler = $this->kernel->getContainer()->get($handlerNamespace);

        if (! $handler instanceof HandlerInterface) {
            throw new Exception('Wrong handler!');
        }

        return $handler;
    }
}
