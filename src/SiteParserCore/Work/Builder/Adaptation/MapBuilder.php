<?php declare(strict_types=1);
namespace App\SiteParserCore\Work\Builder\Adaptation;

use App\SiteParserCore\Resource\Entity\ORM\ParameterTree;
use App\SiteParserCore\Resource\Entity\ORM\ParameterGroup;
use App\SiteParserCore\Resource\Entity\ORM\GroupParameters;
use App\SiteParserCore\Work\Builder\BuilderInterface;

class MapBuilder implements BuilderInterface
{
    public const STRING_MODE = 1;
    public const NUMBER_MODE = 2;

    public function build(ParameterGroup $parameterGroup, int $mode = self::STRING_MODE): array
    {
        $map = [];

        /** @var GroupParameters $groupParameters */
        foreach ($parameterGroup->getParameters() as $groupParameters) {
            $rowName = $groupParameters->getParameter()->getName();
            $map[$rowName] = $map[$rowName] ?? [];

            $rowValuesIndex = 0;

            /** @var ParameterTree $childrenTree */
            foreach ($groupParameters->getParameter()->getChildrenRelations() as $childrenTree) {
                $childName = $childrenTree->getChild()->getName();

                $map[$rowName][$childName] = $map[$rowName][$childName] ?? null;
    
                foreach ($childrenTree->getChild()->getValues() as $value) {
                    if ($this->isValueNumeric($value->getValue())) {
                        $map[$rowName][$childName] = (float) $value->getValue();
                    } else {
                        $map[$rowName][$childName] = $value->getValue();
                    }
                }

                $rowValuesIndex++;
            }
        }

        return $map;
    }

    private function isValueNumeric($value): bool
    {
        $floatValueCast = (float) $value;
        $intValueCast = (int) $value;

        $valueIsFloatIntStringFormat = strlen((string) $value) === strlen((string) $floatValueCast);
        $valueIsIntIntStringFormat = strlen((string) $value) === strlen((string) $intValueCast);

        if ($valueIsFloatIntStringFormat) {
            $value = $floatValueCast;
        }

        if ($valueIsIntIntStringFormat) {
            $value = $intValueCast;
        }

        return is_float($value) || is_int($value);
    }
}
