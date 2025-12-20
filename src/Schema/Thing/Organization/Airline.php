<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\Organization;

use Rami\SeoBundle\Schema\Thing\Organization;

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
