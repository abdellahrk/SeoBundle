<?php

namespace Rami\SeoBundle\Schema\Thing;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\DataType\Text\Url;
use Rami\SeoBundle\Schema\Intangible\Brand;
use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;
use Rami\SeoBundle\Schema\Place\CivicStructure\EducationalOrganization;
use Rami\SeoBundle\Schema\Thing;
use Rami\SeoBundle\Schema\Thing\Place\AdministrativeArea\Country;

class Person extends Thing
{
    public function additionalName(string $additionalName): static
    {
        $this->setProperty('additionalName', $additionalName);
        return $this;
    }

    public function award(string $award): static
    {
        $this->setProperty('award', $award);
        return $this;
    }

    public function jobTitle(string $jobTitle): static
    {
        $this->setProperty('jobTitle', $jobTitle);
        return $this;
    }

    public function birthDate(\DateTime $birthDate): static
    {
        $this->setProperty('birthDate', $birthDate->format('Y-m-d'));
        return $this;
    }

    public function birthPlace(string $birthPlace): static
    {
        $this->setProperty('birthPlace', $birthPlace);
        return $this;
    }

    public function email(string $email): static
    {
        $this->setProperty('email', $email);
        return $this;
    }

    public function familyName(string $familyName): static
    {
        $this->setProperty('familyName', $familyName);
        return $this;
    }

    public function givenName(string $givenName): static
    {
        $this->setProperty('givenName', $givenName);
        return $this;
    }

    public function telephone(string $telephone): static
    {
        $this->setProperty('telephone', $telephone);
        return $this;
    }

    public function address(string|PostalAddress $address): static
    {
        if (is_string($address)) {
            $this->setProperty('address', $address);
            return $this;
        }

        $this->setProperty('address', $this->parseChild($address));
        return $this;
    }

    public function relatedTo(string|Person $relatedTo): static
    {
        if (is_string($relatedTo)) {
            $this->setProperty('relatedTo', $relatedTo);
            return $this;
        }

        $this->setProperty('relatedTo', $this->parseChild($relatedTo));
        return $this;
    }

    public function alumniOf(EducationalOrganization|Organization $alumniOf): static
    {
        $this->setProperty('alumniOf', $this->parseChild($alumniOf));
        return $this;
    }

    public function brand(Organization|Brand $brand): static
    {
        $this->setProperty('brand', $this->parseChild($brand));
        return $this;
    }

    public function callSign(string $callSign): static
    {
        $this->setProperty('callSign', $callSign);
        return $this;
    }

    public function children(array|Person $children): static
    {
        if (is_array($children)) {
            $this->setProperty('children', $this->parseArray($children));
            return $this;
        }

        $this->setProperty('children', $this->parseChild($children));
        return $this;
    }

    public function colleague(Person|Url $colleague): static
    {
        $this->setProperty('colleague', $this->parseChild($colleague));
        return $this;
    }

    public function spouse(Person $person): static
    {
        $this->setProperty('spouse', $this->parseChild($person));
        return $this;
    }

    public function worksFor(Organization $organization): static
    {
        $this->setProperty('worksFor', $this->parseChild($organization));
        return $this;
    }

    public function nationality(Country $country): static
    {
        $this->setProperty('nationality', $this->parseChild($country));
        return $this;
    }
}