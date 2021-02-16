<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Builder\Adaptation;

use App\SiteParserCore\Resource\Entity\ORM\ParameterGroup;
use App\SiteParserCore\Work\Builder\BuilderInterface;

class LiteralMapBuilder implements BuilderInterface
{
    public const DEFAULT_VALUE = -1;

    private $mapBuilder;

    public function __construct(MapBuilder $mapBuilder)
    {
        $this->mapBuilder = $mapBuilder;
    }

    public function build(ParameterGroup $parameterGroup, int $mode = MapBuilder::STRING_MODE): array
    {
        $map = $this->mapBuilder->build($parameterGroup, $mode);

        $literalLegend = $this->getLiteralLegend($map);
        $map = $this->filterLiteral($map, $literalLegend);

        return [
            'map' => $this->filterLiteral($map, $literalLegend),
            'literal-legend' => $literalLegend,
        ];
    }

    private function isValueNumeric($value): bool
    {
        return is_float($value) || is_int($value);
    }

    private function getLiteralLegend(array $map): array
    {
        $parameterIterators = [];
        $literal = [];

        foreach ($map as $rowName => $rowValues) {
            foreach ($rowValues as $parameterName => $value) {
                if ($this->isValueNumeric($value)) {
                    continue;
                }

                $parameterIterators[$parameterName] = $parameterIterators[$parameterName] ?? static::DEFAULT_VALUE + 1;
                $literal[$parameterName] = $literal[$parameterName] ?? [];

                if (! isset($literal[$parameterName][$value])) {
                    $literal[$parameterName][$value] = $parameterIterators[$parameterName];
                    $parameterIterators[$parameterName]++;
                }
            }
        }

        return $literal;
    }

    private function filterLiteral(array $map, array $literalMap): array
    {
        foreach ($map as $rowName => $rowValues) {
            foreach ($rowValues as $parameterName => $value) {
                if (isset($literalMap[$parameterName]) && isset($literalMap[$parameterName][$value])) {
                    $map[$rowName][$parameterName] = $literalMap[$parameterName][$value];
                }
            }
        }

        return $map;
    }
}
