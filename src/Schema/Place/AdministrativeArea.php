<?php

namespace Rami\SeoBundle\Schema\Place;

use Rami\SeoBundle\Schema\BaseType;

class AdministrativeArea extends BaseType
{
    public array $properties = [];

    public function branchCode(string $branchCode): static
    {
        $this->setProperty('branchCode', $branchCode);
        return $this;
    }
}