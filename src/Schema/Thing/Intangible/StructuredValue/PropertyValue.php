<?php

namespace Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue;

use Rami\SeoBundle\Schema\BaseType;

class PropertyValue extends BaseType
{
    public function propertyID(string $propertyID): static
    {
        $this->setProperty('propertyID', $propertyID);
        return $this;
    }

    public function value(string|int|float|bool $value): static
    {
        $this->setProperty('value', $value);
        return $this;
    }

    public function valueReference(BaseType $valueReference): static
    {
        $this->setProperty('valueReference', $this->parseChild($valueReference));
        return $this;
    }

    public function minValue(int|float $minValue): static
    {
        $this->setProperty('minValue', $minValue);
        return $this;
    }

    public function maxValue(int|float $maxValue): static
    {
        $this->setProperty('maxValue', $maxValue);
        return $this;
    }

    public function unitCode(string $unitCode): static
    {
        $this->setProperty('unitCode', $unitCode);
        return $this;
    }

    public function unitText(string $unitText): static
    {
        $this->setProperty('unitText', $unitText);
        return $this;
    }
}
