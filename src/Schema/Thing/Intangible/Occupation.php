<?php

namespace Rami\SeoBundle\Schema\Thing\Intangible;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Place\AdministrativeArea;
use Rami\SeoBundle\Schema\Thing;

class Occupation extends Thing
{
    public function educationRequirements(Thing\CreativeWork\EducationalOccupationalCredential|string $educationRequirements): static
    {
        if ($educationRequirements instanceof BaseType) {
            $this->setProperty('educationRequirements', $this->parseChild($educationRequirements));
        } else {
            $this->setProperty('educationRequirements', $educationRequirements);
        }
        return $this;
    }

    public function estimatedSalary(Thing\Intangible\StructuredValue\MonetaryAmount|Thing\Intangible\StructuredValue\QuantitativeValueDistribution\MonetaryAmountDistribution|int $estimatedSalary): static
    {
        if ($estimatedSalary instanceof BaseType) {
            $this->setProperty('estimatedSalary', $this->parseChild($estimatedSalary));
        } else {
            $this->setProperty('estimatedSalary', $estimatedSalary);
        }
        return $this;
    }

    public function occupationLocation(AdministrativeArea $occupationLocation): static
    {
        $this->setProperty('occupationLocation', $this->parseChild($occupationLocation));
        return $this;
    }

    public function qualifications(Thing\CreativeWork\EducationalOccupationalCredential|string $qualifications): static
    {
        if ($qualifications instanceof BaseType) {
            $this->setProperty('qualifications', $this->parseChild($qualifications));
        } else {
            $this->setProperty('qualifications', $qualifications);
        }
        return $this;
    }

    public function responsibilities(string $responsibilities): static
    {
        $this->setProperty('responsibilities', $responsibilities);
        return $this;
    }

    public function skills(Thing\Intangible\DefinedTerm|string $skills): static
    {
        if ($skills instanceof BaseType) {
            $this->setProperty('skills', $this->parseChild($skills));
        } else {
            $this->setProperty('skills', $skills);
        }
        return $this;
    }
}