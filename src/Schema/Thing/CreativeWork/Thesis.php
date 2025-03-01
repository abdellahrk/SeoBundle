<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing\CreativeWork;

use Abdellahramadan\SeoBundle\Schema\BaseType;

class Thesis extends BaseType
{
    public function isSupportOf(string $isSupportOf): static
    {
        $this->setProperty('isSupportOf', $isSupportOf);
        return $this;
    }
}