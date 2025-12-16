<?php

namespace Rami\SeoBundle\Schema\Thing\Organization;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Traits\OrganizationTrait;

class Airline extends Organization
{
    public function iataCode(string $iataCode): self
    {
        $this->setProperty('iataCode', $iataCode);
        return $this;
    }

    public function boardingPolicy(): static
    {

        return $this;
    }
}