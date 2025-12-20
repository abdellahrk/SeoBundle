<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\QuantitativeValueDistribution;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Traits\CurrencyPropertiesTrait;

class MonetaryAmountDistribution extends BaseType
{
    use CurrencyPropertiesTrait;
}
