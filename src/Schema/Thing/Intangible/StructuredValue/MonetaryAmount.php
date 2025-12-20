<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Traits\CurrencyPropertiesTrait;

class MonetaryAmount extends BaseType
{
    use CurrencyPropertiesTrait;

    public function value(string|int $value): static
    {
        $this->setProperty('value', $value);

        return $this;
    }
}
