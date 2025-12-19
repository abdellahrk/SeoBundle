<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Place;

use Rami\SeoBundle\Schema\Thing\Place;

class AdministrativeArea extends Place
{
    public array $properties = [];

    /**
     * @return $this
     */
    public function branchCode(string $branchCode): static
    {
        $this->setProperty('branchCode', $branchCode);

        return $this;
    }
}
