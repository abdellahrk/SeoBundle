<?php

namespace Abdellahramadan\SeoBundle\Schema\Intangible;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Place\AdministrativeArea;

class Audience extends BaseType
{
    public array $properties = [];
    public function audienceType(string $audienceType): static
    {
        $this->setProperty('audienceType', $audienceType);
        return $this;
    }

    public function geographicArea(AdministrativeArea $administrativeArea): static
    {
        $this->setProperty('geographicArea', $administrativeArea);
        return $this;
    }
}