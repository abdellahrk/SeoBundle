<?php

namespace Rami\SeoBundle\Schema;

use Rami\SeoBundle\Schema\Traits\ThingsTrait;

class Thing extends BaseType
{
    use ThingsTrait;

    public array $properties = [];
}