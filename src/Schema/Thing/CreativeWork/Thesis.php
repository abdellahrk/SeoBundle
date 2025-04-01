<?php

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\BaseType;

class Thesis extends BaseType
{
    public function isSupportOf(string $isSupportOf): static
    {
        $this->setProperty('isSupportOf', $isSupportOf);
        return $this;
    }
}