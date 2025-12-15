<?php

namespace Rami\SeoBundle\Schema;

use Rami\SeoBundle\Schema\Intangible\Service;
use Rami\SeoBundle\Schema\Thing\Action;
use Rami\SeoBundle\Schema\Thing\CreativeWork;
use Rami\SeoBundle\Schema\Thing\CreativeWork\ImageObject;
use Rami\SeoBundle\Schema\Thing\CreativeWork\TextObject;
use Rami\SeoBundle\Schema\Thing\Intangible\StructuredValue\PropertyValue;
use Rami\SeoBundle\Schema\Thing\Organization;
use Rami\SeoBundle\Schema\Thing\Person;
use Rami\SeoBundle\Schema\Traits\ThingsTrait;

class Thing extends BaseType
{
    use ThingsTrait;

    public array $properties = [];
}