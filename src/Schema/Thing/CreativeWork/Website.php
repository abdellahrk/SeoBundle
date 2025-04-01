<?php

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Traits\CreativeWorkTrait;

class Website extends BaseType
{
    use CreativeWorkTrait;

    public function ssn(string $ssn): static
    {
        $this->setProperty('ssn', $ssn);
        return $this;
    }
}