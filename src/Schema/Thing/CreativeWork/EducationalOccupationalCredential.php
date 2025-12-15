<?php

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\DataType\Text\Url;
use Rami\SeoBundle\Schema\Place\AdministrativeArea;
use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\Intangible\DefinedTerm;
use Rami\SeoBundle\Schema\Thing\Organization;

class EducationalOccupationalCredential extends CreativeWork
{
    public function competencyRequired(DefinedTerm|string|Url $competency): static
    {
        $this->setProperty('competencyRequired', is_string($competency) ? $competency : $this->parseChild($competency));
        return $this;
    }

    public function credentialCategory(DefinedTerm|string|Url $category): static
    {
        $this->setProperty('credentialCategory', is_string($category) ? $category : $this->parseChild($category));
        return $this;
    }

    public function educationalLevel(Organization $educationalLevel): static
    {
        $this->setProperty('educationalLevel', $this->parseChild($educationalLevel));
        return $this;
    }

    public function recognizedBy(Organization $recognizedBy): static
    {
        $this->setProperty('recognizedBy', $this->parseChild($recognizedBy));
        return $this;
    }

    public function validIn(AdministrativeArea $validIn): static
    {
        $this->setProperty('validIn', $this->parseChild($validIn));
        return $this;
    }
}