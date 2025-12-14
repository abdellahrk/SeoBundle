<?php

namespace Rami\SeoBundle\Schema\Thing;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;

class Place extends BaseType
{
    public array $properties = [];

    public function address(PostalAddress $address): static
    {
        $this->setProperty('address', $this->parseChild($address));
        return $this;
    }
}