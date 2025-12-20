<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Intangible\StructuredValue;

use Rami\SeoBundle\Schema\Place\AdministrativeArea;
use Rami\SeoBundle\Schema\Thing;
use Rami\SeoBundle\Schema\Thing\Place;

use function is_string;

class ContactPoint extends Thing
{
    public function areaServed(string|AdministrativeArea|Place|GeoShape $areaServed): static
    {
        if (is_string($areaServed)) {
            $this->setProperty('areaServed', $areaServed);

            return $this;
        }

        $this->setProperty('areaServed', $this->parseChild($areaServed));

        return $this;
    }

    public function contactType(string $contactType): static
    {
        $this->setProperty('contactType', $contactType);

        return $this;
    }

    public function email(string $email): static
    {
        $this->setProperty('email', $email);

        return $this;
    }

    public function faxNumber(string $faxNumber): static
    {
        $this->setProperty('faxNumber', $faxNumber);

        return $this;
    }

    public function telephone(string $telephone): static
    {
        $this->setProperty('telephone', $telephone);

        return $this;
    }
}
