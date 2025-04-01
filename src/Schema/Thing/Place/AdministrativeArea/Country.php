<?php

namespace Rami\SeoBundle\Schema\Thing\Place\AdministrativeArea;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;

class Country extends BaseType
{
    public array $properties = [];

    public function address(string|PostalAddress $address): static
    {
        if (is_string($address)) {
            $this->setProperty('address', $address);
            return $this;
        }

        $this->setProperty('address', $this->parseChild($address));
        return $this;
    }
}