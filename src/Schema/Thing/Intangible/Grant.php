<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing\Intangible;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Thing\Organization;
use Abdellahramadan\SeoBundle\Schema\Thing\Person;

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