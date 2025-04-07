<?php

namespace Rami\SeoBundle\Schema\Place;

use Rami\SeoBundle\Schema\BaseType;

class AdministrativeArea extends BaseType
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