<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Adapter\Export;

use App\SiteParserCore\Work\Adapter\AdapterInterface;

class ExternalExportAdapter implements AdapterInterface
{
    public static function adaptMapBuilderResultInCsvFormat(array $mapBuilderResult): array
    {
        $headers = [];
        $headerPosition = [];
        $values = [];

        $iterator = 0;
        $headerPositionIterator = 0;
        foreach ($mapBuilderResult as $rowName => $rowValues) {
            $values[$iterator] = [];
            foreach ($rowValues as $name => $value) {
                if (! isset($headers[$name])) {
                    $headers[$name] = $name;
                    $headerPosition[$name] = $headerPositionIterator++;
                }

                $values[$iterator][$headerPosition[$name]] = $value;
            }
            $iterator++;
        }

        return array_merge(
            [array_values($headers)],
            $values
        );
    }

    public static function adaptLiteralMapBuilderResultInCsvFormat(array $literalMapBuilderResult): array
    {
        return static::adaptMapBuilderResultInCsvFormat($literalMapBuilderResult['map']);
    }
}
