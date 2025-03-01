<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing\Intangible\StructuredValue;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint;
use Abdellahramadan\SeoBundle\Schema\Traits\CurrencyPropertiesTrait;

class MonetaryAmount extends BaseType
{
    use CurrencyPropertiesTrait;

    public function value(string|int $value): static
    {
        $this->setProperty('value', $value);
        return $this;
    }
}