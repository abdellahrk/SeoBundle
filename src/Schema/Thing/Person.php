<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint\PostalAddress;

class Person extends BaseType
{
    public array $properties = [];

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

}