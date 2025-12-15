<?php

namespace Rami\SeoBundle\Schema\Thing;

use Rami\SeoBundle\Schema\Thing;
use Rami\SeoBundle\Schema\Traits\CreativeWorkTrait;
use Rami\SeoBundle\Schema\Traits\ThingTrait;

class CreativeWork extends Thing
{
    use CreativeWorkTrait;

    public array $properties = [];
}