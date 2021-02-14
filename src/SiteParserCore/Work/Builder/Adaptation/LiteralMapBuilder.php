<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Builder\Adaptation;

use App\SiteParserCore\Resource\Entity\ORM\ParameterGroup;
use App\SiteParserCore\Work\Builder\BuilderInterface;

class LiteralMapBuilder implements BuilderInterface
{
    public const OFFSET_DEFAULT_VALUE = 1;

    private $mapBuilder;

    public function __construct(MapBuilder $mapBuilder)
    {
        $this->mapBuilder = $mapBuilder;
    }

    public function build(ParameterGroup $parameterGroup, int $mode = MapBuilder::STRING_MODE): array
    {
        $map = $this->mapBuilder->build($parameterGroup, $mode);
        $map = $this->filterNumericValues($map);

        $offsetMap = $this->getParameterOffsetMap($map);
        $map = $this->filterOffset($map, $offsetMap);

        $literalMap = $this->getParameterLiteralMap($map);
        $map = $this->filterLiteral($map, $literalMap);

        return [
            'map' => $map,
            'literal' => $literalMap,
            'offset' => $offsetMap,
        ];
    }

    private function isValueNumeric($value): bool
    {
        return is_float($value) || is_int($value);
    }

    private function filterNumericValues(array $map): array
    {
        foreach ($map as $rowName => $rowValues) {
            foreach ($rowValues as $parameterName => $value) {
                if (! $this->isValueNumeric($value)) {
                    continue;
                }

                $intValue = (int) round($value);
                $map[$rowName][$parameterName] = $intValue;
            }
        }

        return $map;
    }

    private function getParameterOffsetMap(array $map): array
    {
        $offset = [];
        $parameterStack = [];

        foreach ($map as $rowName => $rowValues) {
            foreach ($rowValues as $parameterName => $value) {
                if (! $this->isValueNumeric($value)) {
                    continue;
                }

                $parameterStack[$parameterName] = $parameterStack[$parameterName] ?? [];
                $parameterStack[$parameterName][] = $value;
            }
        }

        foreach ($parameterStack as $parameterName => $values) {
            $offset[$parameterName] = min($values) - static::OFFSET_DEFAULT_VALUE;
        }

        return $offset;
    }

    private function filterOffset(array $map, array $offsetMap): array
    {
        foreach ($map as $rowName => $rowValues) {
            foreach ($rowValues as $parameterName => $value) {
                if (! $this->isValueNumeric($value)) {
                    continue;
                }

                $map[$rowName][$parameterName] = $value - $offsetMap[$parameterName];
            }
        }

        return $map;
    }

    private function getParameterLiteralMap(array $map): array
    {
        $parameterIterators = [];
        $literal = [];

        foreach ($map as $rowName => $rowValues) {
            foreach ($rowValues as $parameterName => $value) {
                if ($this->isValueNumeric($value)) {
                    continue;
                }

                $parameterIterators[$parameterName] = $parameterIterators[$parameterName] ?? static::OFFSET_DEFAULT_VALUE + 1;
                $literal[$parameterName] = $literal[$parameterName] ?? [];

                if (! isset($literal[$parameterName][$value])) {
                    $literal[$parameterName][$value] = $parameterIterators[$parameterName]++;
                }
            }
        }

        return $literal;
    }

    private function filterLiteral(array $map, array $literalMap): array
    {
        foreach ($map as $rowName => $rowValues) {
            foreach ($rowValues as $parameterName => $value) {
                if ($this->isValueNumeric($value)) {
                    continue;
                }

                $map[$rowName][$parameterName] = $literalMap[$parameterName][$value];
            }
        }

        return $map;
    }
}
