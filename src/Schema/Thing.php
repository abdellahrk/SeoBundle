<?php

namespace Rami\SeoBundle\Schema;

use Rami\SeoBundle\Schema\Traits\ThingTrait;

class Thing extends BaseType
{
    use ThingTrait;

    public array $properties = [];
}