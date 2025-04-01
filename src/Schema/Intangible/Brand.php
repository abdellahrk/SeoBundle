<?php

namespace Rami\SeoBundle\Schema\Intangible;

use Rami\SeoBundle\Schema\BaseType;

class Brand extends BaseType
{
    public function slogan(string $slogan): static
    {
        $this->setProperty('slogan', $slogan);
        return $this;
    }

}