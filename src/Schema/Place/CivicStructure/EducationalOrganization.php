<?php

namespace Abdellahramadan\SeoBundle\Schema\Place\CivicStructure;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Thing\Person;

class EducationalOrganization extends BaseType
{
    public function alumni(Person $alumni): static
    {
        $this->setProperty('alumni', $this->parseChild($alumni));
        return $this;
    }
}