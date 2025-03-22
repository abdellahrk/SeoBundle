<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing\Organization;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Traits\OrganizationTrait;

class Airline extends BaseType
{
    use OrganizationTrait;

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