<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Builder\Adaptation;

use App\SiteParserCore\Resource\Entity\ORM\ParameterGroup;
use App\SiteParserCore\Work\Builder\BuilderInterface;

class LiteralMapBuilder implements BuilderInterface
{
    private $mapBuilder;

    public function __construct(MapBuilder $mapBuilder)
    {
        $this->mapBuilder = $mapBuilder;
    }

    public function build(ParameterGroup $parameterGroup, int $mode = MapBuilder::STRING_MODE): array
    {
        $legend = [];
        $literal = [];
        $reversedLiteral = [];
        $map = $this->mapBuilder->build($parameterGroup, $mode);

        foreach ($map as $rowName => $rowValues) {
            foreach ($rowValues as $parameterName => $value) {
                if (is_float($value)) {
                    continue;
                }

                $valueHash = md5($value);
                $legend[$parameterName] = $legend[$parameterName] ?? [];
                $legend[$parameterName][$valueHash] = $value;
                $map[$rowName][$parameterName] = $valueHash;
            }
        }

        foreach ($legend as $parameterName => $parameterHashedValues) {
            $iterator = 0;
            $literal[$parameterName] = $literal[$parameterName] ?? [];
            $reversedLiteral[$parameterName] = $reversedLiteral[$parameterName] ?? [];

            foreach ($parameterHashedValues as $valueHash => $value) {
                $literal[$parameterName][$iterator] = $valueHash;
                $reversedLiteral[$parameterName][$valueHash] = $iterator;

                $iterator++;
            }
        }

        foreach ($map  as $rowName => $rowValues) {
            foreach ($rowValues as $parameterName => $valueHash) {
                if (is_float($valueHash)) {
                    continue;
                }
                
                $map[$rowName][$parameterName] = $reversedLiteral[$parameterName][$valueHash];
            }
        }
        
        foreach ($literal as $parameterName => $parameterHashedValues) {
            foreach ($parameterHashedValues as $key => $valueHash) {
                $literal[$parameterName][$key] = $legend[$parameterName][$valueHash];
            }
        }

        return [
            'map' => $map,
            'legend' => $literal,
        ];
    }
}
