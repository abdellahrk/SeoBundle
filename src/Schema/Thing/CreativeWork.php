<?php

namespace Rami\SeoBundle\Schema\Thing;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Traits\CreativeWorkTrait;

class CreativeWork extends BaseType
{
    use CreativeWorkTrait;

    public array $properties = [];


}