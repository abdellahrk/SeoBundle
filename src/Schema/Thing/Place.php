<?php

namespace Rami\SeoBundle\Schema\Thing;

use Rami\SeoBundle\Schema\BaseType;

class Place extends BaseType
{
    public array $properties = [];

    public function address(string $address): static
    {
        $this->setProperty('address', $address);
        return $this;
    }
}