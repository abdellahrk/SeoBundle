<?php

namespace Rami\SeoBundle\Schema\Intangible\StructuredValue;

use Rami\SeoBundle\Schema\Thing;

class GeoShape extends Thing
{
    public function box(string $box): static
    {
        $this->setProperty('box', $box);
        return $this;
    }

    public function polygon(string $polygon): static
    {
        $this->setProperty('polygon', $polygon);
        return $this;
    }

    public function line(string $line): static
    {
        $this->setProperty('line', $line);
        return $this;
    }

    public function elevation(string $elevation): static
    {
        $this->setProperty('elevation', $elevation);
        return $this;
    }

    public function postalCode(string $postalCode): static
    {
        $this->setProperty('postalCode', $postalCode);
        return $this;
    }
}