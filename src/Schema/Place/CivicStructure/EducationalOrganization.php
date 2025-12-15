<?php

namespace Rami\SeoBundle\Schema\Place\CivicStructure;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Person;

class EducationalOrganization extends Organization
{
    public function alumni(Person $alumni): static
    {
        $this->setProperty('alumni', $this->parseChild($alumni));
        return $this;
    }
}