<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Thing\Intangible;

use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint;
use Rami\SeoBundle\Schema\Thing;
use Rami\SeoBundle\Schema\Thing\CreativeWork\EducationalOccupationalCredential;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\MonetaryAmount;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\MonetaryValue;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\QuantitativeValueDistribution\MonetaryAmountDistribution;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Person;

use function is_int;
use function is_string;

class JobPosting extends Thing
{
    public function title(string $title): self
    {
        $this->setProperty('title', $title);

        return $this;
    }

    public function totalJobsOpening(int $totalJobsOpening): self
    {
        $this->setProperty('totalJobsOpening', $totalJobsOpening);

        return $this;
    }

    public function salaryCurrency(string $salaryCurrency): self
    {
        $this->setProperty('salaryCurrency', $salaryCurrency);

        return $this;
    }

    public function responsibilities(string $responsibilities): self
    {
        $this->setProperty('responsibilities', $responsibilities);

        return $this;
    }

    public function skills(DefinedTerm|string $skills): self
    {
        if (is_string($skills)) {
            $this->setProperty('skills', $skills);

            return $this;
        }

        $this->setProperty('skills', $this->parseChild($skills));

        return $this;
    }

    public function qualifications(EducationalOccupationalCredential|string $qualifications): self
    {
        if (is_string($qualifications)) {
            $this->setProperty('qualifications', $qualifications);

            return $this;
        }

        $this->setProperty('qualifications', $this->parseChild($qualifications));

        return $this;
    }

    public function relevantOccupation(Occupation $occupation): self
    {
        $this->setProperty('relevantOccupation', $this->parseChild($occupation));

        return $this;
    }

    public function hiringOrganization(Organization|Person $hiringOrganization): self
    {
        $this->setProperty('hiringOrganization', $this->parseChild($hiringOrganization));

        return $this;
    }

    public function incentiveCompensation(string $incentiveCompensation): self
    {
        $this->setProperty('incentiveCompensation', $incentiveCompensation);

        return $this;
    }

    public function jobBenefits(string $jobBenefits): self
    {
        $this->setProperty('jobBenefits', $jobBenefits);

        return $this;
    }

    public function jobImmediateStart(bool $jobImmediateStart): self
    {
        $this->setProperty('jobImmediateStart', $jobImmediateStart);

        return $this;
    }

    public function estimatedSalary(int|MonetaryValue|MonetaryAmountDistribution $estimated): static
    {
        if (is_int($estimated)) {
            $this->setProperty('estimatedSalary', $estimated);

            return $this;
        }

        $this->setProperty('estimatedSalary', $this->parseChild($estimated));

        return $this;
    }

    public function directApply(bool $directApply): self
    {
        $this->setProperty('directApply', $directApply);

        return $this;
    }

    public function baseSalary(MonetaryAmount|int $baseSalary): self
    {
        if (is_int($baseSalary)) {
            $this->setProperty('baseSalary', $baseSalary);

            return $this;
        }

        $this->setProperty('baseSalary', $this->parseChild($baseSalary));

        return $this;
    }

    public function applicationContact(ContactPoint $contactPoint): static
    {
        $this->setProperty('applicationContact', $this->parseChild($contactPoint));

        return $this;
    }

    public function employerOverview(string $employerOverview): self
    {
        $this->setProperty('employerOverview', $employerOverview);

        return $this;
    }

    public function employmentType(string $employmentType): self
    {
        $this->setProperty('employmentType', $employmentType);

        return $this;
    }

    public function employmentUnit(Organization $organization): self
    {
        $this->setProperty('employmentUnit', $this->parseChild($organization));

        return $this;
    }

    public function experienceInPlaceOfEducation(bool $experienceInPlaceOfEducation): self
    {
        $this->setProperty('experienceInPlaceOfEducation', $experienceInPlaceOfEducation);

        return $this;
    }

    public function industry(DefinedTerm|string $industry): self
    {
        if (is_string($industry)) {
            $this->setProperty('industry', $industry);

            return $this;
        }

        $this->setProperty('industry', $this->parseChild($industry));

        return $this;
    }

    public function workHours(string $workHours): self
    {
        $this->setProperty('workHours', $workHours);

        return $this;
    }
}
