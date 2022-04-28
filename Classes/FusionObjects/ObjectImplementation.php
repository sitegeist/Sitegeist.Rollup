<?php
declare(strict_types=1);

namespace Sitegeist\Rollup\FusionObjects;

use Neos\Fusion\Exception\RuntimeException;
use Neos\Fusion\FusionObjects\AbstractArrayFusionObject;

class ObjectImplementation extends AbstractArrayFusionObject
{

    protected function getClassName():string
    {
        return $this->fusionValue('__meta/className');
    }

    public function evaluate()
    {
        $className = $this->getClassName();
        $properties = $this->evaluateNestedProperties('Neos.Fusion:DataStructure');

        if (!class_exists($className)) {
            throw new RuntimeException(sprintf('class %s does not exist', $className));
        }

        return new $className(...$properties);
    }
}
