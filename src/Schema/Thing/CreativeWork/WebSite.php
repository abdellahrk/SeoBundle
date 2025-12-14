<?php

namespace Rami\SeoBundle\Schema\Thing\CreativeWork;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Traits\CreativeWorkTrait;

class WebSite extends BaseType
{
    use CreativeWorkTrait;

    public function issn(string $ssn): static
    {
        $this->setProperty('issn', $ssn);
        return $this;
    }
}