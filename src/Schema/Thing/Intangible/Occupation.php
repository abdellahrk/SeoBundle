<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\Intangible;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Place\AdministrativeArea;
use Rami\SeoBundle\Schema\Thing;
use Rami\SeoBundle\Schema\Thing\CreativeWork\EducationalOccupationalCredential;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\MonetaryAmount;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\QuantitativeValueDistribution\MonetaryAmountDistribution;

class Occupation extends Thing
{
    public function educationRequirements(EducationalOccupationalCredential|string $educationRequirements): static
    {
        if ($educationRequirements instanceof BaseType) {
            $this->setProperty('educationRequirements', $this->parseChild($educationRequirements));
        } else {
            $this->setProperty('educationRequirements', $educationRequirements);
        }

        return $this;
    }

    public function estimatedSalary(MonetaryAmount|MonetaryAmountDistribution|int $estimatedSalary): static
    {
        if ($estimatedSalary instanceof BaseType) {
            $this->setProperty('estimatedSalary', $this->parseChild($estimatedSalary));
        } else {
            $this->setProperty('estimatedSalary', $estimatedSalary);
        }

        return $this;
    }

    public function occupationLocation(AdministrativeArea $administrativeArea): static
    {
        $this->setProperty('occupationLocation', $this->parseChild($administrativeArea));

        return $this;
    }

    public function qualifications(EducationalOccupationalCredential|string $qualifications): static
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

    public function skills(DefinedTerm|string $skills): static
    {
        if ($skills instanceof BaseType) {
            $this->setProperty('skills', $this->parseChild($skills));
        } else {
            $this->setProperty('skills', $skills);
        }

        return $this;
    }
}
