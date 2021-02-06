<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Command\Execution;

use App\SiteParserCore\Resource\Marker\ExecutionCommandInterface;
use App\SiteParserCore\Work\Service\Execution\ExecutionService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExecutionCommand extends Command implements ExecutionCommandInterface
{
    protected static $defaultName = 'site-parser:execution';

    private $executionService;

    public function __construct(
        ExecutionService $executionService,
        string $name = null
    ) {
        $this->executionService = $executionService;

        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->executionService->execute();

        return static::SUCCESS;
    }
}
