<?php

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\Thing\CreativeWork;

class Thesis extends CreativeWork
{
    public function isSupportOf(string $isSupportOf): static
    {
        $this->setProperty('isSupportOf', $isSupportOf);
        return $this;
    }
}