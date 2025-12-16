<?php

namespace Rami\SeoBundle\Schema\Place;

use Rami\SeoBundle\Schema\Thing\Place;

class AdministrativeArea extends Place
{
    /**
     * @var array
     */
    public array $properties = [];

    /**
     * @param string $branchCode
     * @return $this
     */
    public function branchCode(string $branchCode): static
    {
        $this->setProperty('branchCode', $branchCode);
        return $this;
    }
}