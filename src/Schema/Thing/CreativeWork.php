<?php

namespace Rami\SeoBundle\Schema\Thing;

use Rami\SeoBundle\Schema\Thing;
use Rami\SeoBundle\Schema\Traits\CreativeWorkTrait;

class CreativeWork extends Thing
{
    use CreativeWorkTrait;

    public array $properties = [];


}