<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing\CreativeWork;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Traits\CreativeWorkTrait;

class Website extends BaseType
{
    use CreativeWorkTrait;

    public function ssn(string $ssn): static
    {
        $this->setProperty('ssn', $ssn);
        return $this;
    }
}