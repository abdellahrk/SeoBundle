<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\DataType\Text\Url;
use Rami\SeoBundle\Schema\Place\AdministrativeArea;
use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\Intangible\DefinedTerm;
use Rami\SeoBundle\Schema\Thing\Organization;

use function is_string;

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

    public function educationalLevel(Organization $organization): static
    {
        $this->setProperty('educationalLevel', $this->parseChild($organization));

        return $this;
    }

    public function recognizedBy(Organization $organization): static
    {
        $this->setProperty('recognizedBy', $this->parseChild($organization));

        return $this;
    }

    public function validIn(AdministrativeArea $administrativeArea): static
    {
        $this->setProperty('validIn', $this->parseChild($administrativeArea));

        return $this;
    }
}
