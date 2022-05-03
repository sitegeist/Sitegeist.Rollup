<?php
declare(strict_types=1);

namespace Sitegeist\Rollup\FusionObjects;

use Neos\Fusion\Exception\RuntimeException;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

class ObjectImplementation extends AbstractFusionObject
{

    protected function getClassName(): string
    {
        return $this->fusionValue('className');
    }

    protected function getFactoryMethod(): ?string
    {
        return $this->fusionValue('factoryMethod');
    }

    protected function getArguments(): array
    {
        return $this->fusionValue('arguments');
    }

    public function evaluate()
    {
        $className = $this->getClassName();
        $arguments = $this->getArguments();
        $factoryMethod = $this->getFactoryMethod();

        if (!class_exists($className)) {
            throw new RuntimeException(sprintf('Class %s does not exist', $className));
        }

        if ($factoryMethod) {
            return $className::$factoryMethod(...$arguments);
        } else {
            return new $className(...$arguments);
        }
    }
}
