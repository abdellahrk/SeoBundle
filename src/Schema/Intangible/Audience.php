<?php

declare(strict_types=1);

namespace Rami\SeoBundle\Schema\Intangible;

use Rami\SeoBundle\Schema\Place\AdministrativeArea;
use Rami\SeoBundle\Schema\Thing;

class Audience extends Thing
{
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
