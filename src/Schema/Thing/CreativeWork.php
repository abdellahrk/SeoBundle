<?php

namespace Rami\SeoBundle\Schema\Thing;

use Rami\SeoBundle\Schema\BaseType;
use Rami\SeoBundle\Schema\Traits\CreativeWorkTrait;
use Rami\SeoBundle\Schema\Traits\ThingTrait;

class CreativeWork extends BaseType
{
    use CreativeWorkTrait;
    use ThingTrait;

    public array $properties = [];
}