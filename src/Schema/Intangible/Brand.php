<?php

namespace Abdellahramadan\SeoBundle\Schema\Intangible;

use Abdellahramadan\SeoBundle\Schema\BaseType;

class Brand extends BaseType
{
    public function slogan(string $slogan): static
    {
        $this->setProperty('slogan', $slogan);
        return $this;
    }

}