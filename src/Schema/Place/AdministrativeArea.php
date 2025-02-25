<?php

namespace Abdellahramadan\SeoBundle\Schema\Place;

use Abdellahramadan\SeoBundle\Schema\BaseType;

class AdministrativeArea extends BaseType
{
    public array $properties = [];

    public function branchCode(string $branchCode): static
    {
        $this->setProperty('branchCode', $branchCode);
        return $this;
    }
}