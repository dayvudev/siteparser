<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Service\Export;

use App\SiteParserCore\Work\Service\ServiceInterface;
use Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Yaml\Yaml;

class ExternalExportService implements ServiceInterface
{
    public const DIRECTORY = '%s/var/external-export/%s/';
    public const PATH = self::DIRECTORY . 'export.%s';

    private $serializer;
    private $slugger;
    private $filesystem;

    private $projectDir;
    private $name = null;
    private $data = null;
    private $csvContent;
    private $jsonContent;
    private $yamlContent;

    public function __construct(
        SluggerInterface $slugger,
        Filesystem $filesystem,
        KernelInterface $kernel
    ) {
        $this->slugger = $slugger;
        $this->filesystem = $filesystem;
        $this->serializer = new Serializer([], [
            new CsvEncoder(),
            new JsonEncoder(),
            new YamlEncoder()
        ]);

        $this->projectDir = $kernel->getProjectDir();
    }

    public function execute(): void
    {
        $this->createDirectory();

        $this->executeCsvExport();
        $this->executeJsonExport();
        $this->executeYamlExport();
    }
    
    public function executeCsvExport(): void
    {
        $this->csvContent = $this->serializer->serialize($this->getData(), 'csv', [
            'output_utf8_bom' => true,
            'csv_delimiter' => ';',
            'no_headers' => true
        ]);

        $this->createFile($this->csvContent, 'csv');
    }
    
    public function executeJsonExport(): void
    {
        $this->jsonContent = $this->serializer->serialize($this->getData(), 'json', [
            'json_encode_options' => JSON_PRETTY_PRINT
        ]);

        $this->createFile($this->jsonContent, 'json');
    }
    
    public function executeYamlExport(): void
    {
        $this->yamlContent = $this->serializer->serialize($this->getData(), 'yaml');

        $this->createFile($this->yamlContent, 'yaml');
    }

    private function createDirectory(): void
    {
        $directory = sprintf(static::DIRECTORY, $this->projectDir, $this->getName());

        if (! $this->filesystem->exists($directory)) {
            $this->filesystem->mkdir($directory);
        }
    }

    private function createFile(string $content, string $extension): void
    {
        $path = sprintf(
            static::PATH,
            $this->projectDir,
            $this->getName(),
            $extension
        );

        if ($this->filesystem->exists($path)) {
            $this->filesystem->remove($path);
        }

        $this->filesystem->appendToFile($path, $content);
    }

    public function getData(): array
    {
        if (null === $this->data) {
            throw new Exception('Property "data" is required!');
        }

        return $this->data;
    }

    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getName(): string
    {
        if (null === $this->name) {
            throw new Exception('Property "name" is required!');
        }
        
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = (string) $this->slugger->slug($name);

        return $this;
    }
}
