<?php

namespace Rami\SeoBundle\Schema\Thing\Product;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Traits\ProductTrait;

class IndividualProduct extends BaseType
{
    use ProductTrait;

    public function serialNumber(string $serialNumber): static
    {
        $this->setProperty('serialNumber', $serialNumber);
        return $this;
    }
}