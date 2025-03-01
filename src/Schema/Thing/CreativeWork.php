<?php

namespace Abdellahramadan\SeoBundle\Schema\Thing;

use Abdellahramadan\SeoBundle\Schema\BaseType;
use Abdellahramadan\SeoBundle\Schema\Traits\CreativeWorkTrait;

class CreativeWork extends BaseType
{
    use CreativeWorkTrait;

    public array $properties = [];


}