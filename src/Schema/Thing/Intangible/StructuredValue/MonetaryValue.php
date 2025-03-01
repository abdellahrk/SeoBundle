<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing\Intangible\StructuredValue;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Traits\CurrencyPropertiesTrait;

class MonetaryValue extends BaseType
{
    use CurrencyPropertiesTrait;

    public function maxValue(int $maxValue): static
    {
        $this->setProperty('maxValue', $maxValue);
        return $this;
    }

    public function minValue(int $minValue): static
    {
        $this->setProperty('minValue', $minValue);
        return $this;
    }
}