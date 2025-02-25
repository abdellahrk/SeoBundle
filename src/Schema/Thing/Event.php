<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing;

use Abdellahramadan\SeoBundle\Schema\BaseType;

class Event extends BaseType
{
    public array $properties = [];

    public function startDate(\DateTime $startDate): static
    {
        $this->setProperty('startDate', $startDate->format('Y-m-d H:i:s'));
        return $this;
    }

    public function endDate(\DateTime $endDate): static
    {
        $this->setProperty('endDate', $endDate->format('Y-m-d H:i:s'));
        return $this;
    }
}