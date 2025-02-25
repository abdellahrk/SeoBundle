<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing;

use Abdellahramadan\SeoBundle\Schema\BaseType;

class CreativeWork extends BaseType
{
    public array $properties = [];

    public function abstract(string $abstract): static
    {
        $this->setProperty('abstract', $abstract);
        return $this;
    }

    public function expires(\DateTime $dateTime): static
    {
        $this->setProperty('expires', $dateTime);
        return $this;
    }
}