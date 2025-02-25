<?php

namespace Abdellahramadan\SeoBundle\Schema\Intangible\StructuredValue;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Place\AdministrativeArea;
use Abdellahramadan\SeoBundle\Schema\Thing\Place;

class ContactPoint extends BaseType
{
    public array $properties = [];

    public function areaServed(string|AdministrativeArea|Place|GeoShape $areaServed): static
    {
        if (is_string($areaServed)) {
            $this->setProperty('areaServed', $areaServed);
            return $this;
        }

        $this->setProperty('areaServed', $this->parseChild($areaServed));
        return $this;
    }
}