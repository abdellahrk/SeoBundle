<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint;

use Rami\SeoBundle\Schema\Intangible\StructuredValue\ContactPoint;
use Rami\SeoBundle\Schema\Thing\Place\AdministrativeArea\Country;

use function is_string;

class PostalAddress extends ContactPoint
{
    public function addressCountry(string|Country $addressCountry): static
    {
        if (is_string($addressCountry)) {
            $this->setProperty('addressCountry', $addressCountry);

            return $this;
        }

        $this->setProperty('addressCountry', $this->parseChild($addressCountry));

        return $this;
    }

    public function addressLocality(string $addressLocality): static
    {
        $this->setProperty('addressLocality', $addressLocality);

        return $this;
    }

    public function addressRegion(string $addressRegion): static
    {
        $this->setProperty('addressRegion', $addressRegion);

        return $this;
    }

    public function postalCode(string $postalCode): static
    {
        $this->setProperty('postalCode', $postalCode);

        return $this;
    }

    public function postOfficeBoxNumber(string $postalOfficeBoxNumber): static
    {
        $this->setProperty('postalOfficeBoxNumber', $postalOfficeBoxNumber);

        return $this;
    }

    public function streetAddress(string $streetAddress): static
    {
        $this->setProperty('streetAddress', $streetAddress);

        return $this;
    }
}
