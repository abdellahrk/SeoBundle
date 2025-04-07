<?php

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Thing\Intangible\DefinedTerm;
use Rami\SeoBundle\Schema\Traits\CreativeWorkTrait;

class Course extends BaseType
{
    use CreativeWorkTrait;

    public function courseCode(string $courseCode): static
    {
        $this->setProperty('courseCode', $courseCode);
        return $this;
    }

    public function totalHistoralEnrollmennt(string $totalHistoralEnrollment): static
    {
        $this->setProperty('totalHistoralEnrollment', $totalHistoralEnrollment);
        return $this;
    }

    public function financialAidEligible(DefinedTerm|string $financialAidEligible): static
    {
        if ($financialAidEligible instanceof DefinedTerm) {
            $this->setProperty('financialAidEligible', $this->parseChild($financialAidEligible));
        } else  {
            $this->setProperty('financialAidEligible', $financialAidEligible);
            return $this;
        }

        return $this;
    }

    public function availableLanguage(string $availableLanguage): static
    {
        $this->setProperty('availableLanguage', $availableLanguage);
        return $this;
    }
}