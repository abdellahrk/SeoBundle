<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Traits\CurrencyPropertiesTrait;

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
