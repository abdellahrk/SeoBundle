<?php

namespace Rami\SeoBundle\Schema\Thing\Intangible;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Person;

class Grant extends BaseType
{
    public function funder(Person|Organization $funder): static
    {
        $this->setProperty('funder', $this->parseChild($funder));
        return $this;
    }

    public function sponsor(Person|Organization $sponsor): static
    {
        $this->setProperty('sponsor', $this->parseChild($sponsor));
        return $this;
    }
}