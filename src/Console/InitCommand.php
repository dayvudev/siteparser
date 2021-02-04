<?php declare(strict_types=1);
namespace App\Console;

use LogicException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class InitCommand extends Command
{
    public const HELP = [
        '',
        '<fg=cyan;options=bold>Usage</>',
        '<fg=cyan;options=bold>-------------------------------------</>',
        '<fg=green;options=bold>bin/console init DIRECTORY_NAME</>',
        '',
        '<fg=cyan;options=bold>Directory Structure</>',
        '<fg=cyan;options=bold>-------------------------------------</>',
        '<fg=green;options=bold>Business</>',
        '    What is <fg=green;options=bold>Business</>?',
        '    <fg=white;>This directory describes business logic elements, term definitions, and the API.</>',
        '    <fg=white;>The <fg=green;options=bold>Business</> directory contains:</>',
        '        - <fg=yellow>Api</>',
        '        - <fg=yellow>Event</>',
        '        - <fg=yellow>Facade</>',
        '        - <fg=yellow>Interpreter</>',
        '        - <fg=yellow>Presenter</>',
        '        - <fg=yellow>Specification</>',
        '        - <fg=yellow>Validator</>',
        '<fg=green;options=bold>Resource</>',
        '    What is <fg=green;options=bold>Resource</>?',
        '    <fg=white;>This directory describes items that do not contain any action that affects another object.</>',
        '    <fg=white;>The <fg=green;options=bold>Resource</> directory contains:</>',
        '        - <fg=yellow>Bridge</>',
        '        - <fg=yellow>Entity</>',
        '        - <fg=yellow>Iterator</>',
        '        - <fg=yellow>Marker</>',
        '        - <fg=yellow>NullState</>',
        '        - <fg=yellow>Pool</>',
        '        - <fg=yellow>Repository</>',
        '<fg=green;options=bold>Work</>',
        '    What is <fg=green;options=bold>Work</>?',
        '    <fg=white;>This directory describes the items that affect other objects by their action.</>',
        '    <fg=white;>The <fg=green;options=bold>Work</> directory contains:</>',
        '        - <fg=yellow>Adapter</>',
        '        - <fg=yellow>Builder</>',
        '        - <fg=yellow>Command</>',
        '        - <fg=yellow>Factory</>',
        '        - <fg=yellow>Handler</>',
        '        - <fg=yellow>Mediator</>',
        '        - <fg=yellow>Observer</>',
        '        - <fg=yellow>Provider</>',
        '        - <fg=yellow>Service</>',
    ];

    public const DIRECTORY_STRUCTURE = [
        'Business' => [
            'Api' => [],
            'Event' => [],
            'Facade' => [],
            'Interpreter' => [],
            'Presenter' => [],
            'Specification' => [],
            'Validator' => [],
        ],
        'Resource' => [
            'Bridge' => [],
            'Entity' => [],
            'Iterator' => [],
            'Marker' => [],
            'NullState' => [],
            'Pool' => [],
            'Repository' => [],
        ],
        'Work' => [
            'Adapter' => [],
            'Builder' => [],
            'Command' => [],
            'Factory' => [],
            'Handler' => [],
            'Mediator' => [],
            'Observer' => [],
            'Provider' => [],
            'Service' => [],
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
        $this->addArgument('component', InputArgument::REQUIRED, 'The new component name.');
        $this->setHelp(implode("\n", static::HELP));
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(static::HELP);

        $component = $input->getArgument('component');
        $component = ucfirst($component);

        $path = $this->kernel->getProjectDir() . '/src/' . $component . '/';
        if (! $this->filesystem->exists($path)) {
            $this->filesystem->mkdir($path);
        } else {
            throw new LogicException('Directory already exists!');
        }

        foreach (static::DIRECTORY_STRUCTURE as $layer => $subDirectories) {
            $subPath = $path . $layer . '/';

            if (! $this->filesystem->exists($subPath)) {
                $layerInterfaceName = $layer . 'Interface.php';
                $layerInterfaceContent = $this->getLayerInterfaceContent($component, $layer);

                $this->filesystem->mkdir($subPath);
                $this->filesystem->touch($subPath . $layerInterfaceName);
                $this->filesystem->appendToFile($subPath . $layerInterfaceName, $layerInterfaceContent);
            }

            foreach ($subDirectories as $layerPart => $subDirSubDirectories) {
                $subSubPath = $subPath . $layerPart . '/';
                if (! $this->filesystem->exists($subSubPath)) {
                    $layerPartInterfaceName = $layerPart . 'Interface.php';
                    $layerPartInterfaceContent = $this->getLayerPartInterfaceContent($component, $layer, $layerPart);

                    $this->filesystem->mkdir($subSubPath);
                    $this->filesystem->touch($subSubPath . $layerPartInterfaceName);
                    $this->filesystem->appendToFile($subSubPath . $layerPartInterfaceName, $layerPartInterfaceContent);
                }
            }
        }

        return Command::SUCCESS;
    }

    private function getLayerInterfaceContent(string $component, string $layer): string
    {
        $php = '<?php declare(strict_types=1);' . "\n";
        $php .= 'namespace App\\' . $component . '\\' .  $layer . ';' . "\n";
        $php .= "\n";
        $php .= 'interface ' . $layer . 'Interface' . "\n";
        $php .= '{' . "\n";
        $php .= '}' . "\n";

        return $php;
    }

    private function getLayerPartInterfaceContent(string $component, string $layer, string $part): string
    {
        $php = '<?php declare(strict_types=1);' . "\n";
        $php .= 'namespace App\\' . $component . '\\' .  $layer . '\\' . $part . ';' . "\n";
        $php .= "\n";
        $php .= 'use App\\' . $component . '\\' .  $layer . '\\' .  $layer . 'Interface' . ';' . "\n";
        $php .= "\n";
        $php .= 'interface ' . $part . 'Interface extends ' . $layer . 'Interface' . "\n";
        $php .= '{' . "\n";
        $php .= '}' . "\n";

        return $php;
    }
}