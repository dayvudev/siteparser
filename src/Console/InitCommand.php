<?php declare(strict_types=1);
namespace App\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class InitCommand extends Command
{
    public const DIRECTORY_STRUCTURE = [
        'Resource' => [
            'Entity' => [],
            'Pool' => [], 
            'Repository' => [],
            'Provider' => [],
            'View' => [],
            'Iterator' => [],
            'Decorator' => [],
        ],
        'Business' => [
            'Facade' => [], 
            'Interpreter' => [],
            'Proxy' => [],
            'Visitor' => [],
            'Observer' => [],
            'Presenter' => [],
        ],
        'Work' => [
            'Adapter' => [],
            'Factory' => [],
            'Builder' => [], 
            'Management' => [],
            'Service' => [],
            'Bridge' => [],
        ],
    ];

    protected static $defaultName = 'init';

    protected $kernel;
    protected $filesystem;

    public function __construct(
        KernelInterface $kernel,
        Filesystem $filesystem,
        string $name = null
    ) {
        $this->kernel = $kernel;
        $this->filesystem = $filesystem;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this->addArgument('feature', InputArgument::REQUIRED, 'The new feature name.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $feature = $input->getArgument('feature');
        $feature = ucfirst($feature);

        $path = $this->kernel->getProjectDir() . '/src/' . $feature . '/';
        if (! $this->filesystem->exists($path)) {
            $this->filesystem->mkdir($path);
            $this->filesystem->touch($path . '.gitkeep');
        }

        foreach (static::DIRECTORY_STRUCTURE as $dirPath => $subDirectories) {
            $subPath = $path . $dirPath . '/';
            if (! $this->filesystem->exists($subPath)) {
                $this->filesystem->mkdir($subPath);
                $this->filesystem->touch($subPath . '.gitkeep');
            }

            foreach ($subDirectories as $subDirPath => $subDirSubDirectories) {
                $subSubPath = $subPath . $subDirPath . '/';
                if (! $this->filesystem->exists($subSubPath)) {
                    $this->filesystem->mkdir($subSubPath);
                    $this->filesystem->touch($subSubPath . '.gitkeep');
                }
            }
        }

        return Command::SUCCESS;
    }
}