<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing\Product;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Traits\ProductTrait;

class IndividualProduct extends BaseType
{
    use ProductTrait;

    public function serialNumber(string $serialNumber): static
    {
        $this->setProperty('serialNumber', $serialNumber);
        return $this;
    }
}